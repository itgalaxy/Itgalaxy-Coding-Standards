<?php
namespace ItgalaxyCodingStandards\Sniffs\Formatting;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class ExitParensSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_EXIT];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                   $stackPtr  The position of the current token in
     *                                         the stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $nonWhitespaceToken = $phpcsFile->findNext(T_WHITESPACE, $stackPtr + 1, null, true);

        if ($tokens[$nonWhitespaceToken]['code'] === T_OPEN_PARENTHESIS) {
            return;
        }

        $phpcsFile->addError('Exit or die should have parenthesis', $stackPtr, 'ExitParens');
    }
}
