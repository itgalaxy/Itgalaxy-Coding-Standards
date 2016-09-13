<?php
namespace ItgalaxyCodingStandards\Sniffs\Strings;

class NoPlusStringConcatSniff implements \PHP_CodeSniffer_Sniff
{
    public function register()
    {
        return [T_PLUS];
    }

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
