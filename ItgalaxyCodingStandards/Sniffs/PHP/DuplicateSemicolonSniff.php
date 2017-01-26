<?php
namespace ItgalaxyCodingStandards\Sniffs\PHP;

class DuplicateSemicolonSniff implements \PHP_CodeSniffer_Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_SEMICOLON];
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
        $tokens = $phpcsFile->getTokens();
        $previousIndex = $phpcsFile->findPrevious(\PHP_CodeSniffer_Tokens::$emptyTokens, $stackPtr - 1, null, true);

        if (!$previousIndex || $tokens[$previousIndex]['code'] !== T_SEMICOLON) {
            return;
        }

        $possibleForIndex = $phpcsFile->findPrevious(T_FOR, $previousIndex - 1);

        if ($possibleForIndex && $tokens[$possibleForIndex]['parenthesis_closer'] > $stackPtr) {
            return;
        }

        $fix = $phpcsFile->addFixableError('Duplicate semicolon found', $stackPtr);

        if ($fix) {
            $phpcsFile->fixer->beginChangeset();
            $phpcsFile->fixer->replaceToken($stackPtr, '');

            for ($i = $stackPtr; $i > $previousIndex; --$i) {
                if ($tokens[$i]['code'] === T_WHITESPACE) {
                    $phpcsFile->fixer->replaceToken($i, '');
                }
            }

            $phpcsFile->fixer->endChangeset();
        }
    }
}
