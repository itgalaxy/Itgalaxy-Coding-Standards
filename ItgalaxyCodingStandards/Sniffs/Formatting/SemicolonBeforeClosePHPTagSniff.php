<?php
namespace ItgalaxyCodingStandards\Sniffs\Formatting;

class SemicolonBeforeClosePHPTagSniff implements \PHP_CodeSniffer_Sniff
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
        return [T_CLOSE_TAG];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                   $stackPtr  The position of the current token in
     *                                         the stack passed in $tokens.
     *
     * @return void
     */
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $prev = $stackPtr - 1;

        while ($prev !== 0) {
            if (!in_array($tokens[$prev]['code'], \PHP_CodeSniffer_Tokens::$emptyTokens)) {
                break;
            }

            $prev--;
        }

        if ($tokens[$prev]['code'] === T_OPEN_CURLY_BRACKET
            || $tokens[$prev]['code'] === T_CLOSE_CURLY_BRACKET
            || $tokens[$prev]['code'] === T_OPEN_TAG
            || $tokens[$prev]['code'] === T_COLON
        ) {
            return;
        }

        if ($tokens[$prev]['code'] !== T_SEMICOLON) {
            $error = 'Before close php tag must be semicolon';
            $phpcsFile->addError($error, $stackPtr, 'SemicolonBeforeClosePHPTag');
        }
    }
}
