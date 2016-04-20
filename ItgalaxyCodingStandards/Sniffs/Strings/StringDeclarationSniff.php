<?php
namespace ItgalaxyCodingStandards\Sniffs\Strings;

class StringDeclarationSniff implements \PHP_CodeSniffer_Sniff
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
     * @param int                  $stackPtr  The position of the current token
     *                                        in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if ($tokens[$stackPtr + 1]['code'] === T_CONSTANT_ENCAPSED_STRING
            || $tokens[$stackPtr + 1]['code'] === T_DOUBLE_QUOTED_STRING
        ) {
            $error = 'Multiline string declaration not allowed';
            $phpcsFile->addError($error, $stackPtr + 1, 'MultilineStringDeclaration');
        }
    }
}
