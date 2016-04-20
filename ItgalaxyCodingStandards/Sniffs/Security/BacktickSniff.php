<?php
namespace ItgalaxyCodingStandards\Sniffs\Security;

class BacktickSniff implements \PHP_CodeSniffer_Sniff
{
    public function register()
    {
        return [T_BACKTICK];
    }
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if ($tokens[$stackPtr]['code'] === T_BACKTICK) {
            $phpcsFile->addError(
                'Incorrect usage of back quote string constant. Back quotes should be always inside strings.',
                $stackPtr,
                'WrongBackQuotesUsage'
            );
        }
    }
}
