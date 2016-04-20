<?php
namespace ItgalaxyCodingStandards\Sniffs\Formatting;

class ParenthesisCastExpressionSniff implements \PHP_CodeSniffer_Sniff
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
        return \PHP_CodeSniffer_Tokens::$castTokens;
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token in
     *                                        the stack passed in $tokens.
     *
     * @return void
     */
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        // Todo переписать
        $tokens = $phpcsFile->getTokens();
        $next = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), null, true);

        if ($tokens[$next]['code'] === T_OPEN_PARENTHESIS) {
            $parenthesisCloser = $tokens[$next]['parenthesis_closer'];

            $nextAfterParenthesis = $phpcsFile->findNext(T_WHITESPACE, ($parenthesisCloser + 1), null, true);

            $excludeTokens = array_merge(
                [
                    T_COLON,
                    T_STRING_CONCAT,
                    T_COMMA,
                    T_SEMICOLON,
                    T_CLOSE_PARENTHESIS,
                    T_AS,
                    T_CLOSE_SHORT_ARRAY
                ],
                [
                    T_INLINE_THEN,
                    T_INLINE_ELSE
                ],
                [T_CLOSE_TAG],
                \PHP_CodeSniffer_Tokens::$comparisonTokens,
                \PHP_CodeSniffer_Tokens::$booleanOperators
            );

            if (!in_array($tokens[$nextAfterParenthesis]['code'], $excludeTokens)) {
                $error = 'No parenthesis before and after case expression';
                $phpcsFile->addError($error, $next, 'NoParenthesisCastExpression');
            }
        } else {
            $error = 'No parenthesis before and after case expression';
            $phpcsFile->addError($error, $next, 'NoParenthesisCastExpression');
        }
    }
}
