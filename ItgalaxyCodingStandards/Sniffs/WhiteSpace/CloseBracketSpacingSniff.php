<?php
/**
 * CloseBracketSpacingSniff.
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */

namespace ItgalaxyCodingStandards\Sniffs\WhiteSpace;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Util\Tokens;

/**
 * Checks that there is no white space before a closing bracket, for ")" and "}".
 * Square Brackets are handled by Squiz_Sniffs_Arrays_ArrayBracketSpacingSniff.
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */
class CloseBracketSpacingSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [
            T_CLOSE_CURLY_BRACKET,
            T_CLOSE_PARENTHESIS,
            T_CLOSE_SHORT_ARRAY,
        ];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token
     *                                        in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if (isset($tokens[$stackPtr - 1]) === true
            && $tokens[$stackPtr - 1]['code'] === T_WHITESPACE
        ) {
            $before = $phpcsFile->findPrevious(Tokens::$emptyTokens, $stackPtr - 1, null, true);

            if ($before !== false && $tokens[$stackPtr]['line'] === $tokens[$before]['line']) {
                $error = 'There should be no white space before a closing "%s"';
                $fix = $phpcsFile->addFixableError(
                    $error,
                    $stackPtr - 1,
                    'ClosingWhitespace',
                    [$tokens[$stackPtr]['content']]
                );

                if ($fix === true) {
                    $phpcsFile->fixer->replaceToken($stackPtr - 1, '');
                }
            }
        }
    }
}
