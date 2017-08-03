<?php
namespace ItgalaxyCodingStandards\Sniffs\Formatting;

class DisallowMultipleStatementsSniff implements \PHP_CodeSniffer_Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_SEMICOLON];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                   $stackPtr  The position of the current token in the
     *                                         stack passed in $tokens.
     *
     * @return void
     */
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $prev = $phpcsFile->findPrevious([T_SEMICOLON, T_OPEN_TAG, T_OPEN_TAG_WITH_ECHO], $stackPtr - 1);

        if ($prev === false
            || $tokens[$prev]['code'] === T_OPEN_TAG
            || $tokens[$prev]['code'] === T_OPEN_TAG_WITH_ECHO
        ) {
            $phpcsFile->recordMetric($stackPtr, 'Multiple statements on same line', 'no');
            return;
        }

        // Ignore multiple statements in a FOR condition.
        if (isset($tokens[$stackPtr]['nested_parenthesis']) === true) {
            foreach ($tokens[$stackPtr]['nested_parenthesis'] as $bracket) {
                if (isset($tokens[$bracket]['parenthesis_owner']) === false) {
                    // Probably a closure sitting inside a function call.
                    continue;
                }

                $owner = $tokens[$bracket]['parenthesis_owner'];

                if ($tokens[$owner]['code'] === T_FOR) {
                    return;
                }
            }
        }

        $previousIndex = $phpcsFile->findPrevious(\PHP_CodeSniffer_Tokens::$emptyTokens, $stackPtr - 1, null, true);

        if ($tokens[$prev]['line'] === $tokens[$stackPtr]['line']) {
            $phpcsFile->recordMetric($stackPtr, 'Multiple statements on same line', 'yes');
            $error = 'Each PHP statement must be on a line by itself';
            $fix = $phpcsFile->addFixableError($error, $stackPtr, 'SameLine');

            if ($fix === true) {
                $phpcsFile->fixer->beginChangeset();
                $phpcsFile->fixer->addNewline($prev);

                if ($tokens[($prev + 1)]['code'] === T_WHITESPACE) {
                    $phpcsFile->fixer->replaceToken($prev + 1, '');
                }

                $phpcsFile->fixer->endChangeset();
            }
        } else {
            $prevNonEmptyToken = $phpcsFile->findPrevious(
                \PHP_CodeSniffer_Tokens::$emptyTokens,
                $stackPtr - 1,
                null,
                true
            );

            if ($prevNonEmptyToken === false || $tokens[$prevNonEmptyToken]['code'] !== T_SEMICOLON) {
                return;
            }

            $fix = $phpcsFile->addFixableError('Extra semicolon found', $stackPtr, 'ExtraSemicolon');

            if ($fix) {
                $phpcsFile->fixer->beginChangeset();
                $phpcsFile->fixer->replaceToken($stackPtr, '');

                for ($i = $stackPtr; $i > $previousIndex; --$i) {
                    if ($tokens[$i]['code'] === T_WHITESPACE) {
                        $phpcsFile->fixer->replaceToken($i, '');
                    }
                }

                $phpcsFile->fixer->endChangeset();
            }
        }
    }
}
