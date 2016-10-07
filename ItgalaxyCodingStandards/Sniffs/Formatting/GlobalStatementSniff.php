<?php
namespace ItgalaxyCodingStandards\Sniffs\Formatting;

class GlobalStatementSniff implements \PHP_CodeSniffer_Sniff
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
        return [T_GLOBAL];
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
        $semicolon = $phpcsFile->findNext(T_SEMICOLON, $stackPtr + 1, null, false);
        $nextContent = $phpcsFile->findNext(T_WHITESPACE, $semicolon + 1, null, true);

        if ($tokens[$nextContent]['code'] === T_GLOBAL) {
            $error = 'Join all global in one global';
            $phpcsFile->addError($error, $nextContent, 'MultipleGlobal');
        }
    }
}
