<?php
namespace ItgalaxyCodingStandards\Sniffs\Formatting;

class BlankLineBeforeReturnSniff implements \PHP_CodeSniffer_Sniff
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
        return [T_RETURN];
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
    // Todo refactoring
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $current = $stackPtr;
        $previousLine = $tokens[$stackPtr]['line'] - 1;
        $prevLineTokens = [];

        while ($current >= 0 && $tokens[$current]['line'] >= $previousLine) {
            if ($tokens[$current]['line'] == $previousLine
                && $tokens[$current]['type'] !== 'T_WHITESPACE'
                && $tokens[$current]['type'] !== 'T_COMMENT'
                && $tokens[$current]['type'] !== 'T_DOC_COMMENT_CLOSE_TAG'
                && $tokens[$current]['type'] !== 'T_DOC_COMMENT_WHITESPACE'
            ) {
                $prevLineTokens[] = $tokens[$current]['type'];
            }

            $current--;
        }

        if (isset($prevLineTokens[0])
            && ($prevLineTokens[0] === 'T_OPEN_CURLY_BRACKET'
                || $prevLineTokens[0] === 'T_COLON'
                || $prevLineTokens[0] === 'T_CLOSE_TAG'
                || $prevLineTokens[0] === 'T_INLINE_HTML')
        ) {
            return;
        } elseif (count($prevLineTokens) > 0) {
            $phpcsFile->addError(
                'Missing blank line before return statement',
                $stackPtr
            );
        }
    }
}
