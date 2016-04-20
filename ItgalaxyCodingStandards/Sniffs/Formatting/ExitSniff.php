<?php
namespace ItgalaxyCodingStandards\Sniffs\Formatting;

class ExitSniff implements \PHP_CodeSniffer_Sniff
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
        return [T_EXIT];
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
        $firstContent = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), null, true);

        if ($tokens[$firstContent]['code'] !== T_OPEN_PARENTHESIS) {
            $error = 'Exit or die must have parenthesis';
            $phpcsFile->addError($error, $stackPtr, 'ExitParenthesis');
        } elseif ($tokens[$firstContent]['code'] === T_OPEN_PARENTHESIS) {
            $openParenthesisPtr = $firstContent;
            $endStatementPtr = $phpcsFile->findNext(
                [
                    T_SEMICOLON,
                    T_CLOSE_TAG
                ],
                $firstContent + 1,
                null,
                false
            );
            $closeParenthesisPtr = $phpcsFile->findPrevious(
                T_CLOSE_PARENTHESIS,
                $endStatementPtr - 1,
                $firstContent + 1,
                false
            );
            $error = false;

            for ($i = ($openParenthesisPtr + 1); $i < $closeParenthesisPtr; $i++) {
                if ($tokens[$i]['code'] !== T_WHITESPACE) {
                    $error = true;
                    break;
                }
            }

            if ($error) {
                $phpcsFile->addError(
                    'Use exit(die) with argument is forbidden.',
                    $stackPtr,
                    'ExitArgument',
                    [$tokens[$stackPtr]['content']]
                );
            }
        }
    }
}
