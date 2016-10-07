<?php
namespace ItgalaxyCodingStandards\Sniffs\WhiteSpace;

class CommaSpacingSniff implements \PHP_CodeSniffer_Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_COMMA];
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

        $nextPtr = $stackPtr + 1;

        if (isset($tokens[$nextPtr]) !== true) {
            return;
        }

        if ($tokens[$nextPtr]['code'] !== T_WHITESPACE
            && $tokens[$nextPtr]['code'] !== T_COMMA
            && $tokens[$nextPtr]['code'] !== T_CLOSE_PARENTHESIS
        ) {
            $fix = $phpcsFile->addFixableError(
                'Expected one space after the comma, 0 found',
                $stackPtr,
                'NoSpaceAfterComma'
            );

            if ($fix === true) {
                $phpcsFile->fixer->addContent($stackPtr, ' ');
            }
        }

        $nextNextPtr = $stackPtr + 2;

        if (isset($tokens[$nextNextPtr]) !== true) {
            return;
        }

        if ($tokens[$nextPtr]['code'] === T_WHITESPACE
            && $tokens[$nextPtr]['content'] !== ' '
            && $tokens[$nextNextPtr]['line'] === $tokens[$stackPtr + 1]['line']
        ) {
            $fix = $phpcsFile->addFixableError(
                'Expected one space after the comma, %s found',
                $stackPtr,
                'SpaceAfterComma',
                [strlen($tokens[$stackPtr + 1]['content'])]
            );

            if ($fix === true) {
                $phpcsFile->fixer->replaceToken($stackPtr + 1, ' ');
            }
        }
    }
}
