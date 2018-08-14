<?php
namespace ItgalaxyCodingStandards\Sniffs\PHP;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class StrictComparisonsSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_IS_EQUAL, T_IS_NOT_EQUAL];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param int $stackPtr The position of the current token in the stack.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        $phpcsFile->addError(
            'Found: ' . $tokens[$stackPtr]['content'] . '. Use strict comparisons (=== or !==).',
            $stackPtr,
            'LooseComparison'
        );
    }
}
