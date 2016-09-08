<?php
namespace ItgalaxyCodingStandards\Sniffs\ControlStructures;

class NoEachInLoopConditionSniff implements \PHP_CodeSniffer_Sniff
{
    /**
     * A list of tokenizers this sniff supports.
     *
     * @var array
     */
    public $supportedTokenizers = ['PHP'];

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_WHILE];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile All the tokens found in the document.
     * @param int                  $stackPtr  The position of the current token in
     *                                        the stack passed in $tokens.
     *
     * @return void
     */
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $startToken = $tokens[$stackPtr]['parenthesis_opener'] + 1;
        $endToken = $tokens[$stackPtr]['parenthesis_closer'] - 1;
        $result = $phpcsFile->findNext(T_STRING, $startToken, $endToken, false, 'each');

        if ($result === false) {
            return;
        }

        $message = 'Usage of "each()" not allowed in loop condition. Use "foreach"-loop instead.';
        $phpcsFile->addError($message, $stackPtr, 'NoEachInLoopCondition');
    }
}
