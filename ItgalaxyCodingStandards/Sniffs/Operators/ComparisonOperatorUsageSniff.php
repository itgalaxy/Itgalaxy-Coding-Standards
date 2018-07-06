<?php
namespace ItgalaxyCodingStandards\Sniffs\Operators;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Util\Tokens;

class ComparisonOperatorUsageSniff implements Sniff
{

    /**
     * A list of tokenizers this sniff supports.
     *
     * @var array
     */
    public $supportedTokenizers = ['PHP'];

    /**
     * A list of valid comparison operators.
     *
     * @var array
     */
    private static $validOps = [
        T_IS_IDENTICAL => true,
        T_IS_NOT_IDENTICAL => true,
        T_LESS_THAN => true,
        T_GREATER_THAN => true,
        T_IS_GREATER_OR_EQUAL => true,
        T_IS_SMALLER_OR_EQUAL => true,
        T_INSTANCEOF => true
    ];

    /**
     * A list of invalid operators with their alternatives.
     *
     * @var array<int, string>
     */
    private static $invalidOps = [
        T_IS_EQUAL     => '===',
        T_IS_NOT_EQUAL => '!=='
    ];


    /**
     * Registers the token types that this sniff wishes to listen to.
     *
     * @return array
     */
    public function register()
    {
        return [
            T_IF,
            T_ELSEIF,
            T_INLINE_THEN,
            T_WHILE,
            T_FOR,
            T_RETURN
        ];
    }


    /**
     * Process the tokens that this sniff is listening for.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file where the token was found.
     * @param int                         $stackPtr  The position in the stack where the token
     *                                               was found.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if ($tokens[$stackPtr]['code'] === T_INLINE_THEN) {
            $end = $phpcsFile->findPrevious(Tokens::$emptyTokens, $stackPtr - 1, null, true);

            if ($tokens[$end]['code'] !== T_CLOSE_PARENTHESIS) {
                // This inline IF statement does not have its condition
                // bracketed, so we need to guess where it starts.
                for ($i = $end - 1; $i >= 0; $i--) {
                    if ($tokens[$i]['code'] === T_SEMICOLON) {
                        // Stop here as we assume it is the end
                        // of the previous statement.
                        break;
                    } else if ($tokens[$i]['code'] === T_OPEN_TAG) {
                        // Stop here as this is the start of the file.
                        break;
                    } else if ($tokens[$i]['code'] === T_CLOSE_CURLY_BRACKET) {
                        // Stop if this is the closing brace of
                        // a code block.
                        if (isset($tokens[$i]['scope_opener']) === true) {
                            break;
                        }
                    } else if ($tokens[$i]['code'] === T_OPEN_CURLY_BRACKET) {
                        // Stop if this is the opening brace of
                        // a code block.
                        if (isset($tokens[$i]['scope_closer']) === true) {
                            break;
                        }
                    }
                }

                $start = $phpcsFile->findNext(Tokens::$emptyTokens, $i + 1, null, true);
            } else {
                if (isset($tokens[$end]['parenthesis_opener']) === false) {
                    return;
                }

                $start = $tokens[$end]['parenthesis_opener'];
            }
        } else if ($tokens[$stackPtr]['code'] === T_FOR) {
            if (isset($tokens[$stackPtr]['parenthesis_opener']) === false) {
                return;
            }

            $openingBracket = $tokens[$stackPtr]['parenthesis_opener'];
            $closingBracket = $tokens[$stackPtr]['parenthesis_closer'];

            $start = $phpcsFile->findNext(T_SEMICOLON, $openingBracket, $closingBracket);
            $end = $phpcsFile->findNext(T_SEMICOLON, $start + 1, $closingBracket);

            if ($start === false || $end === false) {
                return;
            }
        } else if ($tokens[$stackPtr]['code'] === T_RETURN) {
            $start = $phpcsFile->findNext(T_WHITESPACE, $stackPtr + 1, null, true);
            $end = $phpcsFile->findNext(T_SEMICOLON, $stackPtr + 1);

            if ($tokens[$start]['code'] === T_SEMICOLON) {
                return;
            }
        } else {
            if (isset($tokens[$stackPtr]['parenthesis_opener']) === false) {
                return;
            }

            $start = $tokens[$stackPtr]['parenthesis_opener'];
            $end = $tokens[$stackPtr]['parenthesis_closer'];
        }

        $foundOps = 0;

        for ($i = $start; $i <= $end; $i++) {
            $type = $tokens[$i]['code'];

            if (isset(self::$invalidOps[$type]) === true) {
                $error = 'Operator %s prohibited; use %s instead';
                $data  = [$tokens[$i]['content'], self::$invalidOps[$type]];
                $phpcsFile->addError($error, $i, 'NotAllowed', $data);
                $foundOps++;
            }
        }
    }
}
