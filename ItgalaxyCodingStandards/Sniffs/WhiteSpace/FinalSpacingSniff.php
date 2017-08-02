<?php
namespace ItgalaxyCodingStandards\Sniffs\WhiteSpace;

class FinalSpacingSniff implements \PHP_CodeSniffer_Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_FINAL];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token
     *                                        in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if (isset($tokens[$stackPtr + 1]) !== false
            && $tokens[$stackPtr + 1]['code'] === T_WHITESPACE
            && $tokens[$stackPtr + 1]['content'] !== ' '
        ) {
            $error = 'Expected one space after final, %s found';
            $fix = $phpcsFile->addFixableError(
                $error,
                $stackPtr,
                'TooManySpacesAfter',
                [strlen($tokens[$stackPtr + 1]['content'])]
            );

            if ($fix === true) {
                $phpcsFile->fixer->replaceToken($stackPtr + 1, ' ');
            }
        }
    }
}
