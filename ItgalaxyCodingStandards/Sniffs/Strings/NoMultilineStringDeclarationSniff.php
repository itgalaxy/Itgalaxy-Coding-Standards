<?php
namespace ItgalaxyCodingStandards\Sniffs\Strings;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class NoMultilineStringDeclarationSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [
            T_CONSTANT_ENCAPSED_STRING,
            T_DOUBLE_QUOTED_STRING
        ];
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

        if ($tokens[$stackPtr + 1]['code'] !== T_CONSTANT_ENCAPSED_STRING
            && $tokens[$stackPtr + 1]['code'] !== T_DOUBLE_QUOTED_STRING
        ) {
            return;
        }

        $error = 'Multiline string declaration is not allowed';
        $phpcsFile->addError($error, $stackPtr + 1, 'NoMultilineStringDeclaration');
    }
}
