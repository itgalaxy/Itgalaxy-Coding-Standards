<?php
namespace ItgalaxyCodingStandards\Sniffs\ControlStructures;

class NoGotoSniff implements \PHP_CodeSniffer_Sniff
{
    /**
     * Registers the tokens that this sniff wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_GOTO];
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
        $error = 'Goto is forbidden';
        $phpcsFile->addError($error, $stackPtr, 'Forbidden');
    }
}
