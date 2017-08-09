<?php
namespace ItgalaxyCodingStandards\Sniffs\Formatting;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class NoArrowNotEqualSniff implements Sniff
{
    /**
     * Registers the tokens that this sniff wants to listen for.
     *
     * @return int[]
     */
    public function register()
    {
        return [T_IS_NOT_EQUAL];
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
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if ($tokens[$stackPtr]['content'] !== '<>') {
            return;
        }

        $fix = $phpcsFile->addFixableError('Not equal must be "!="', $stackPtr, 'WrongIsNotEqual');

        if ($fix === true) {
            $phpcsFile->fixer->replaceToken($stackPtr, '!=');
        }
    }
}
