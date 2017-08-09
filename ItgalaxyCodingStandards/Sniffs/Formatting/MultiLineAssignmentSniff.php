<?php
namespace ItgalaxyCodingStandards\Sniffs\Formatting;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class MultiLineAssignmentSniff implements Sniff
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
     * @param int                  $stackPtr  The position of the current token
     *                                        in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        // Equal sign can't be the last thing on the line.
        $next = $phpcsFile->findNext(T_WHITESPACE, $stackPtr + 1, null, true);

        if ($tokens[$next]['line'] !== $tokens[$stackPtr]['line']) {
            $error = 'Multi-line assignments must have the equal sign on the second line';
            $phpcsFile->addError($error, $stackPtr, 'EqualSignLine');

            return;
        }

        // Make sure it is the first thing on the line, otherwise we ignore it.
        $prev = $phpcsFile->findPrevious(T_WHITESPACE, $stackPtr - 1, false, true);

        if ($tokens[$prev]['line'] === $tokens[$stackPtr]['line']) {
            return;
        } elseif ($tokens[$prev]['line'] + 1 !== $tokens[$stackPtr]['line']) {
            $error = 'Multi-line assignments must have not blank lines between statement and equal sign';
            $phpcsFile->addError($error, $stackPtr, 'NoBlankLinesBeforeEqual');
        }
    }
}
