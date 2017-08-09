<?php
namespace ItgalaxyCodingStandards\Sniffs\Strings;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Util\Tokens;

class NoPlusStringConcatSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_PLUS];
    }

    /**
     * Returns leading comment or self.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile All the tokens found in the document.
     * @param int                   $stackPtr  The position of the current token
     *                                         in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        $prev = $phpcsFile->findPrevious(Tokens::$emptyTokens, $stackPtr - 1, null, true);
        $next = $phpcsFile->findNext(Tokens::$emptyTokens, $stackPtr + 1, null, true);

        if (!(in_array($tokens[$prev]['code'], Tokens::$stringTokens)
                || in_array($tokens[$next]['code'], Tokens::$stringTokens))
        ) {
            return;
        }

        $phpcsFile->addError('Use of "+" operator to concatenate two strings forbidden', $stackPtr, 'Invalid');
    }
}
