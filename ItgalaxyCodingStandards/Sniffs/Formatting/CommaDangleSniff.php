<?php
namespace ItgalaxyCodingStandards\Sniffs\Formatting;

class CommaDangleSniff implements \PHP_CodeSniffer_Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [
            T_CLOSE_PARENTHESIS,
            T_CLOSE_SHORT_ARRAY,
            T_OPEN_CURLY_BRACKET,
            T_SEMICOLON
        ];
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
        $comma = $phpcsFile->findPrevious(\PHP_CodeSniffer_Tokens::$emptyTokens, $stackPtr - 1, null, true);

        if ($comma === false || ($comma && $tokens[$comma]['code'] !== T_COMMA)) {
            return;
        }

        $error = 'There is must not have a trailing comma after the last element';
        $fix = $phpcsFile->addFixableError($error, $comma, 'CommaFound');

        if ($fix) {
            $phpcsFile->fixer->beginChangeset();
            $phpcsFile->fixer->replaceToken($comma, '');
            $phpcsFile->fixer->endChangeset();
        }
    }
}
