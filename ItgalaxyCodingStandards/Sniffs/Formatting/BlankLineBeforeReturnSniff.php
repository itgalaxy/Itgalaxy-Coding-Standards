<?php
namespace ItgalaxyCodingStandards\Sniffs\Formatting;

class BlankLineBeforeReturnSniff implements \PHP_CodeSniffer_Sniff
{
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
     * @param int                   $stackPtr  The position of the current token in
     *                                         the stack passed in $tokens.
     *
     * @return void
     */
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        $beforePtr = $this->getLeadingCommentOrSelf($phpcsFile, $stackPtr);

        $prevToken = $phpcsFile->findPrevious(
            \PHP_CodeSniffer_Tokens::$emptyTokens,
            $beforePtr - 1,
            null,
            true
        );

        if ($tokens[$prevToken]['code'] === T_OPEN_TAG) {
            return;
        }

        if ($tokens[$prevToken]['code'] === T_OPEN_CURLY_BRACKET
            || $tokens[$prevToken]['code'] === T_COLON
            || $tokens[$prevToken]['code'] === T_CLOSE_TAG
            || $tokens[$prevToken]['code'] === T_INLINE_HTML
            || $tokens[$prevToken]['code'] === T_OPEN_TAG
        ) {
            return;
        }

        if ($tokens[$beforePtr]['line'] - $tokens[$prevToken]['line'] !== 1) {
            return;
        }

        $phpcsFile->addError(
            'Missing blank line before return statement',
            $stackPtr
        );
    }

    /**
     * Returns leading comment or self.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile All the tokens found in the document.
     * @param int                   $stackPtr  The position of the current token
     *                                         in the stack passed in $tokens.
     *
     * @return bool|int
     */
    protected function getLeadingCommentOrSelf(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $prevTokens = [$stackPtr];
        $tokens = $phpcsFile->getTokens();

        do {
            $prev = end($prevTokens);

            $newPrev = $phpcsFile->findPrevious(
                T_WHITESPACE,
                ($prev - 1),
                null,
                true
            );

            if ($tokens[$newPrev]['code'] === T_COMMENT
                && $tokens[$newPrev]['line'] === ($tokens[$prev]['line'] - 1)
            ) {
                $prevTokens[] = $newPrev;
            } else {
                break;
            }
        } while (true);

        return end($prevTokens);
    }
}
