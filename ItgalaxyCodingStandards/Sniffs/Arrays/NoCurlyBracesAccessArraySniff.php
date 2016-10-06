<?php
namespace ItgalaxyCodingStandards\Sniffs\Arrays;

class NoCurlyBracesAccessArraySniff implements \PHP_CodeSniffer_Sniff
{
    /**
     * Registers the tokens that this sniff wants to listen for.
     *
     * @return int[]
     */
    public function register()
    {
        return [T_OPEN_CURLY_BRACKET];
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
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $tokenBefore = $phpcsFile->findPrevious(T_WHITESPACE, $stackPtr - 1, null, true);

        if ($tokens[$tokenBefore]['code'] !== T_VARIABLE) {
            return;
        }

        $phpcsFile->addError(
            'Don\'t use curly braces to access to key or value',
            $stackPtr,
            'NoCurlyBracesAccessArray'
        );
    }
}
