<?php
namespace ItgalaxyCodingStandards\Sniffs\Formatting;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class GlobalStatementSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_GLOBAL];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token in
     *                                        the stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $semicolon = $phpcsFile->findNext(T_SEMICOLON, $stackPtr + 1, null, false);
        $nextContent = $phpcsFile->findNext(T_WHITESPACE, $semicolon + 1, null, true);

        if ($tokens[$nextContent]['code'] === T_GLOBAL) {
            $error = 'Join all global in one global';
            $phpcsFile->addError($error, $nextContent, 'MultipleGlobal');
        }
    }
}
