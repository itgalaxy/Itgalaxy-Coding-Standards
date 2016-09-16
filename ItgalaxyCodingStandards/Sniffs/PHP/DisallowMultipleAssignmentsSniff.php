<?php

namespace ItgalaxyCodingStandards\Sniffs\PHP;

class DisallowMultipleAssignmentsSniff implements \PHP_CodeSniffer_Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_EQUAL];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token in the
     *                                        stack passed in $tokens.
     *
     * @return void
     */
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        // Ignore default value assignments in function definitions.
        $function = $phpcsFile->findPrevious(
            [
                T_FUNCTION,
                T_CLOSURE
            ],
            $stackPtr - 1,
            null,
            false,
            null,
            true
        );

        if ($function !== false) {
            $opener = $tokens[$function]['parenthesis_opener'];
            $closer = $tokens[$function]['parenthesis_closer'];

            if ($opener < $stackPtr && $closer > $stackPtr) {
                return;
            }
        }

        /*
            The general rule is:
            Find an equal sign and go backwards along the line. If you hit an
            end bracket, skip to the opening bracket. When you find a variable,
            stop. That variable must be the first non-empty token on the line
            or in the statement. If not, throw an error.
        */
        for ($varToken = ($stackPtr - 1); $varToken >= 0; $varToken--) {
            // Skip brackets.
            if (isset($tokens[$varToken]['parenthesis_opener']) === true
                && $tokens[$varToken]['parenthesis_opener'] < $varToken
            ) {
                $varToken = $tokens[$varToken]['parenthesis_opener'];
                continue;
            }

            if (isset($tokens[$varToken]['bracket_opener']) === true) {
                $varToken = $tokens[$varToken]['bracket_opener'];
                continue;
            }

            if ($tokens[$varToken]['code'] === T_SEMICOLON) {
                // We've reached the next statement, so we
                // didn't find a variable.
                return;
            }

            if ($tokens[$varToken]['code'] === T_VARIABLE) {
                // We found our variable.
                break;
            }
        }

        if ($varToken <= 0) {
            // Didn't find a variable.
            return;
        }

        // Deal with this type of variable: self::$var by setting the var
        // token to be "self" rather than "$var".
        if ($tokens[($varToken - 1)]['code'] === T_DOUBLE_COLON) {
            $varToken = ($varToken - 2);
        }

        // Deal with this type of variable: $obj->$var by setting the var
        // token to be "$obj" rather than "$var".
        if ($tokens[($varToken - 1)]['code'] === T_OBJECT_OPERATOR) {
            $varToken = ($varToken - 2);
        }

        // Deal with this type of variable: $$var by setting the var
        // token to be "$" rather than "$var".
        if ($tokens[($varToken - 1)]['content'] === '$') {
            $varToken--;
        }

        // Ignore member var definitions.
        $prev = $phpcsFile->findPrevious(T_WHITESPACE, ($varToken - 1), null, true);

        if (isset(\PHP_CodeSniffer_Tokens::$scopeModifiers[$tokens[$prev]['code']]) === true) {
            return;
        }

        if ($tokens[$prev]['code'] === T_STATIC) {
            return;
        }

        // Make sure this variable is the first thing in the statement.
        $varLine = $tokens[$varToken]['line'];
        $prevLine = 0;

        for ($i = ($varToken - 1); $i >= 0; $i--) {
            if ($tokens[$i]['code'] === T_OPEN_TAG) {
                // Ignore php tag
                return;
            }

            if ($tokens[$i]['code'] === T_SEMICOLON) {
                // We reached the end of the statement.
                return;
            }

            if ($tokens[$i]['code'] === T_INLINE_THEN) {
                // We reached the end of the inline THEN statement.
                return;
            }

            if ($tokens[$i]['code'] === T_INLINE_ELSE) {
                // We reached the end of the inline ELSE statement.
                return;
            }

            if (isset(\PHP_CodeSniffer_Tokens::$emptyTokens[$tokens[$i]['code']]) === false) {
                $prevLine = $tokens[$i]['line'];
                break;
            }
        }

        // Ignore the first part of FOR loops as we are allowed to
        // assign variables there even though the variable is not the
        // first thing on the line. Also ignore WHILE loops.
        if ($tokens[$i]['code'] === T_OPEN_PARENTHESIS) {
            if (isset($tokens[$i]['parenthesis_owner']) !== true) {
                $ownerIndex = $i;

                // Find owner - there must be one!
                while (isset($tokens[$ownerIndex]['parenthesis_owner']) === false && $ownerIndex > 0) {
                    $ownerIndex--;
                }

                if ($ownerIndex > 0) {
                    // Owner index found.
                    $i = $ownerIndex;
                }
            }

            if (isset($tokens[$i]['parenthesis_owner'])) {
                $owner = $tokens[$i]['parenthesis_owner'];

                if ($tokens[$owner]['code'] === T_FOR) {
                    return;
                }
            }
        }

        // Also ignore WHILE loops and IF conditions.
        $validTokens = [
            T_WHILE,
            T_IF
        ];

        if (isset($tokens[$stackPtr]['nested_parenthesis'])) {
            foreach ($tokens[$stackPtr]['nested_parenthesis'] as $start => $_) {
                if (isset($tokens[$start]['parenthesis_owner'])
                    && in_array($tokens[$tokens[$start]['parenthesis_owner']]['code'], $validTokens, true)
                ) {
                    return;
                }
            }
        }

        if ($prevLine === $varLine) {
            $error = 'Assignments must be the first block of code on a line';
            $phpcsFile->addError($error, $stackPtr, 'Found');
        }
    }
}
