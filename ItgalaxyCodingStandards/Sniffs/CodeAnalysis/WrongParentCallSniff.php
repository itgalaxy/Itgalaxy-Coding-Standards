<?php
namespace ItgalaxyCodingStandards\Sniffs\CodeAnalysis;

class WrongParentCallSniff implements \PHP_CodeSniffer_Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return integer[]
     */
    public function register()
    {
        return [T_PARENT];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                   $stackPtr  The position of the current token in the
     *                                         stack passed in $tokens.
     *
     * @return void
     */
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $functionPtr = $phpcsFile->findPrevious(T_FUNCTION, $stackPtr - 1);

        if ($functionPtr === false) {
            return;
        }

        $doubleColonPtr = $phpcsFile->findNext(T_DOUBLE_COLON, $stackPtr + 1);

        if ($doubleColonPtr === false) {
            return;
        }

        $tokens = $phpcsFile->getTokens();
        $functionName = $phpcsFile->getDeclarationName($functionPtr);
        $methodNamePtr = $phpcsFile->findNext(T_STRING, $stackPtr + 1);

        if ($methodNamePtr === false || $tokens[$methodNamePtr]['content'] === $functionName) {
            return;
        }

        $phpcsFile->addError('Method name mismatch in parent:: call', $stackPtr, 'WrongParentCall');
    }
}
