<?php
/**
 * Drupal_Sniffs_WhiteSpace_EmptyLinesSniff.
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @author   Klaus Purer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */

/**
 * Drupal_Sniffs_WhiteSpace_EmptyLinesSniff.
 *
 * Checks that there are not more than 2 empty lines following each other.
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @author   Klaus Purer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */

namespace ItgalaxyCodingStandards\Sniffs\Formatting;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class MaxEmptyLinesSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_WHITESPACE];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                   $stackPtr  The position of the current token
     *                                         in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if (!$this->isLineContainOnlyWhitespaceByPtr($phpcsFile, $stackPtr)) {
            return;
        }

        $firstPtrOnNextLine = $this->findFirstPtrOnNextLine($phpcsFile, $stackPtr);

        if (!$firstPtrOnNextLine || ($firstPtrOnNextLine && $tokens[$firstPtrOnNextLine]['code'] !== T_WHITESPACE)) {
            return;
        }

        if (!$this->isLineContainOnlyWhitespaceByPtr($phpcsFile, $firstPtrOnNextLine)) {
            return;
        }

        $fix = $phpcsFile->addFixableError('More than 1 blank line not allowed', $stackPtr + 1, 'MaxEmptyLines');

        if ($fix === true) {
            $phpcsFile->fixer->replaceToken($stackPtr + 1, '');
        }
    }

    protected function isLineContainOnlyWhitespaceByPtr(File $phpcsFile, $ptr)
    {
        $tokens = $phpcsFile->getTokens();

        $isPrevTokensOnlyWhitespace = true;
        $isNextTokensOnlyWhitespace = true;

        $prevPtr = $ptr;

        while (($prevPtr = $phpcsFile->findPrevious(T_WHITESPACE, $prevPtr - 1, null, true)) !== false) {
            if ($tokens[$ptr]['line'] !== $tokens[$prevPtr]['line']) {
                break;
            }

            if ($tokens[$prevPtr]['code'] !== T_WHITESPACE) {
                $isPrevTokensOnlyWhitespace = false;
            }
        }

        $nextPtr = $ptr;

        while (($nextPtr = $phpcsFile->findNext(T_WHITESPACE, $nextPtr + 1, null, true)) !== false) {
            if ($tokens[$ptr]['line'] !== $tokens[$nextPtr]['line']) {
                break;
            }

            if ($tokens[$nextPtr]['code'] !== T_WHITESPACE) {
                $isNextTokensOnlyWhitespace = false;
            }
        }

        return $isPrevTokensOnlyWhitespace && $isNextTokensOnlyWhitespace;
    }

    protected function findFirstPtrOnNextLine(File $phpcsFile, $ptr)
    {
        $tokens = $phpcsFile->getTokens();

        $firstPtrOnNextLine = null;

        for ($nextLinePtr = ($ptr + 1); $nextLinePtr < $phpcsFile->numTokens; $nextLinePtr++) {
            if ($tokens[$ptr]['line'] !== $tokens[$nextLinePtr]['line']) {
                $firstPtrOnNextLine = $nextLinePtr;
                break;
            }
        }

        return $firstPtrOnNextLine;
    }
}
