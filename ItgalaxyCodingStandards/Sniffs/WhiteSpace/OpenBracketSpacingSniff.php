<?php
/**
 * OpenBracketSpacingSniff.
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */

namespace ItgalaxyCodingStandards\Sniffs\WhiteSpace;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

/**
 * Checks that there is no white space after an opening bracket, for "(" and "{".
 * Square Brackets are handled by Squiz_Sniffs_Arrays_ArrayBracketSpacingSniff.
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */
class OpenBracketSpacingSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [
            T_OPEN_CURLY_BRACKET,
            T_OPEN_PARENTHESIS,
            T_OPEN_SHORT_ARRAY,
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

        if (isset($tokens[$stackPtr + 1]) === true
            && $tokens[$stackPtr + 1]['code'] === T_WHITESPACE
            && strpos($tokens[$stackPtr + 1]['content'], $phpcsFile->eolChar) === false
            // Allow spaces in template files where the PHP close tag is used.
            && isset($tokens[$stackPtr + 2]) === true
            && $tokens[$stackPtr + 2]['code'] !== T_CLOSE_TAG
        ) {
            $error = 'There should be no white space after an opening "%s"';
            $fix = $phpcsFile->addFixableError(
                $error,
                ($stackPtr + 1),
                'OpeningWhitespace',
                [$tokens[$stackPtr]['content']]
            );

            if ($fix === true) {
                $phpcsFile->fixer->replaceToken(($stackPtr + 1), '');
            }
        }
    }
}
