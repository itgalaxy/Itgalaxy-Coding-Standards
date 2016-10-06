<?php
namespace ItgalaxyCodingStandards\Sniffs\WhiteSpace;

class NoTrailingSpacesSniff implements \PHP_CodeSniffer_Sniff
{
    /**
     * Returns an array of tokens for which this test wants to listen
     *
     * @return array
     */
    public function register()
    {
        return [T_WHITESPACE];
    }

    /**
     * Processes the test
     *
     * @param \PHP_CodeSniffer_File $phpcsFile All the tokens found in the document
     * @param int                   $stackPtr  The position of the current token in
     *                                         the stack passed in $tokens
     *
     * @return void
     */
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        // Do not check first T_WHITESPACE on line
        if ($stackPtr > 0 && $tokens[$stackPtr - 1]['line'] === $tokens[$stackPtr]['line']) {
            return;
        }

        $stackPtrCounter = $stackPtr + 1;

        if (!isset($tokens[$stackPtrCounter])) {
            return;
        }

        $isLineEmpty = true;

        while ($tokens[$stackPtr]['line'] == $tokens[$stackPtrCounter]['line']) {
            $token = $tokens[$stackPtrCounter];

            if ($token['code'] !== T_WHITESPACE) {
                $isLineEmpty = false;
                break;
            }

            $stackPtrCounter++;
        }

        if (!$isLineEmpty || strlen($tokens[$stackPtr]['content']) <= 1) {
            return;
        }

        $error = 'Trailing spaces not allowed';
        $phpcsFile->addError($error, $stackPtr, 'NoTrailingSpaces');
    }
}
