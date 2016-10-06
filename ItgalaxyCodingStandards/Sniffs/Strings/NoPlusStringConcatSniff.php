<?php
namespace ItgalaxyCodingStandards\Sniffs\Strings;

class NoPlusStringConcatSniff implements \PHP_CodeSniffer_Sniff
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
     * @return bool|int
     */
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        $prev = $phpcsFile->findPrevious(\PHP_CodeSniffer_Tokens::$emptyTokens, $stackPtr - 1, null, true);
        $next = $phpcsFile->findNext(\PHP_CodeSniffer_Tokens::$emptyTokens, $stackPtr + 1, null, true);

        if (!(in_array($tokens[$prev]['code'], \PHP_CodeSniffer_Tokens::$stringTokens)
                || in_array($tokens[$next]['code'], \PHP_CodeSniffer_Tokens::$stringTokens))
        ) {
            return;
        }

        $phpcsFile->addError('Use of "+" operator to concatenate two strings forbidden', $stackPtr, 'Invalid');
    }
}
