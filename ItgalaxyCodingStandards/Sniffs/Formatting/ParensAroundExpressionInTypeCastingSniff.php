<?php
namespace ItgalaxyCodingStandards\Sniffs\Formatting;

class ParensAroundExpressionInTypeCastingSniff implements \PHP_CodeSniffer_Sniff
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
        $tokens = $phpcsFile->getTokens();
        $next = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), null, true);

        if ($tokens[$next]['code'] === T_OPEN_PARENTHESIS) {
            $error = 'Do not use parenthesis around expression in type casting';
            $phpcsFile->addError($error, $next, 'NoParensAroundExpressionInTypeCasting');
        }
    }
}
