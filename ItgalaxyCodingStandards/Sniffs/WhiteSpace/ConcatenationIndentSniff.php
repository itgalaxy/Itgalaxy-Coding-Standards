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
     * The number of spaces code should be indented.
     *
     * @var int
     */
    public $indent = 4;

    /**
     * Should tabs be used for indenting?
     *
     * If TRUE, fixes will be made using tabs instead of spaces.
     * The size of each tab is important, so it should be specified
     * using the --tab-width CLI argument.
     *
     * @var bool
     */
    public $tabIndent = false;

    /**
     * The --tab-width CLI value that is being used.
     *
     * @var int
     */
    private $tabWidth = null;

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
            $phpcsFile->addError('No empty newline between concatenate strings.', $stackPtr);
        }
    }
}
