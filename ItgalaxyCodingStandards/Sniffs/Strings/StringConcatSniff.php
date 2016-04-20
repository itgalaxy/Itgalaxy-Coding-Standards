<?php
namespace ItgalaxyCodingStandards\Sniffs\Strings;

class StringConcatSniff implements \PHP_CodeSniffer_Sniff
{
    public function register()
    {
        return [T_PLUS];
    }

    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        $prev = $phpcsFile->findPrevious(T_WHITESPACE, $stackPtr - 1, null, true);
        $next = $phpcsFile->findNext(T_WHITESPACE, $stackPtr + 1, null, true);
        $stringTokens = \PHP_CodeSniffer_Tokens::$stringTokens;

        if (in_array($tokens[$prev]['code'], $stringTokens)
            || in_array($tokens[$next]['code'], $stringTokens)
        ) {
            $phpcsFile->addError('Use of + operator to concatenate two strings detected', $stackPtr, 'Found');
        }
    }
}
