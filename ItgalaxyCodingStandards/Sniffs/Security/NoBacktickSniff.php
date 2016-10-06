<?php
namespace ItgalaxyCodingStandards\Sniffs\Security;

class NoBacktickSniff implements \PHP_CodeSniffer_Sniff
{
    /**
     * Returns the token types that this sniff is interested in.
     *
     * @return array(int)
     */
    public function register()
    {
        return [T_BACKTICK];
    }

    /**
     * Processes the tokens that this sniff is interested in.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file where the token was found.
     * @param int                  $stackPtr  The position in the stack where
     *                                        the token was found.
     *
     * @return void
     */
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $phpcsFile->addError(
            'Forbidden to use backtick operator, back quotes can only be used inside quotes',
            $stackPtr,
            'NoBacktick'
        );
    }
}
