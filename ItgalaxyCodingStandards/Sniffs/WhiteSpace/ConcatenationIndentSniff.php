<?php
namespace ItgalaxyCodingStandards\Sniffs\WhiteSpace;

class ConcatenationIndentSniff implements \PHP_CodeSniffer_Sniff
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
        return [T_STRING_CONCAT];
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

        $position = $stackPtr - 1;

        while ($tokens[$position]['code'] == T_WHITESPACE) {
            $position--;
        }

        if ($tokens[$stackPtr]['line'] - $tokens[$position]['line'] > 1) {
            $phpcsFile->addError(
                'No empty newline between concatenate strings.',
                $stackPtr,
                'NoEmptyLinesBetweenConcat'
            );
        }
    }
}
