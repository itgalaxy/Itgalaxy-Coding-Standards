<?php
/**
 * Php_Sniffs_WhiteSpace_DisallowBlankLinesWithSpacesSniff
 *
 * No blank lines allowed that contain any form of indentation
 *
 * @category  PHP
 * @package   standards
 * @author    Sam Wilson <samwilson@purdue.edu>
 */

namespace ItgalaxyCodingStandards\Sniffs\WhiteSpace;

class DisallowBlankLinesWithSpacesSniff implements \PHP_CodeSniffer_Sniff
{
    /**
     * Returns an array of tokens for which this test wants to listen
     *
     * @return array
     */
    public function register()
    {
        return [T_WHITESPACE];
    }

    /**
     * Processes the test
     *
     * @param \PHP_CodeSniffer_File $phpcsFile All the tokens found in the document
     * @param int                  $stackPtr  The position of the current token in
     *                                        the stack passed in $tokens
     *
     * @return void
     */
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        // Make sure the line is only white space
        if ($stackPtr > 0 && $tokens[($stackPtr - 1)]['line'] === $tokens[$stackPtr]['line']) {
            return;
        }

        $stackPtrCounter = $stackPtr + 1;
        $emptyLineWithSpaces = true;

        if (isset($tokens[$stackPtrCounter])) {
            while ($tokens[$stackPtr]['line'] == $tokens[$stackPtrCounter]['line']) {
                $token = $tokens[$stackPtrCounter];

                if ($token['code'] !== T_WHITESPACE) {
                    $emptyLineWithSpaces = false;
                    break;
                }

                $stackPtrCounter++;
            }
        }

        if ($emptyLineWithSpaces && strlen($tokens[$stackPtr]['content']) > 1) {
            $error = 'Blank lines containing indentation are not allowed.';
            $phpcsFile->addError($error, $stackPtr, 'IndentedBlankLine');
        }
    }
}
