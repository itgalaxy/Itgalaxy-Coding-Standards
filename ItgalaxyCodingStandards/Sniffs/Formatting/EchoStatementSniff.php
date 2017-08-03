<?php
namespace ItgalaxyCodingStandards\Sniffs\Formatting;

class EchoStatementSniff implements \PHP_CodeSniffer_Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [
            T_ECHO,
            T_PRINT
        ];
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
        $endEchoPtr = $phpcsFile->findNext(T_SEMICOLON, $stackPtr + 1, null, false);

        if ($endEchoPtr === false) {
            return;
        }

        $foundComma = false;

        for ($next = $stackPtr + 1; $next <= $endEchoPtr - 1; $next++) {
            if ($tokens[$next]['code'] === T_OPEN_SQUARE_BRACKET) {
                $next = $tokens[$next]['bracket_closer'] + 1;
            }

            if ($tokens[$next]['code'] === T_OPEN_SHORT_ARRAY) {
                $next = $tokens[$next]['bracket_closer'] + 1;
            }

            if ($tokens[$next]['code'] === T_OPEN_PARENTHESIS) {
                $next = $tokens[$next]['parenthesis_closer'] + 1;
            }

            if ($tokens[$next]['code'] === T_COMMA) {
                $foundComma = true;
                break;
            }
        }

        if ($foundComma) {
            $error = 'No multiple output in echo';
            $phpcsFile->addError($error, $stackPtr, 'MultipleOutputInEcho');
        }

        $beforeCommentOrSelfPtr = $this->getLeadingCommentOrSelf($phpcsFile, $stackPtr);
        $firstNonWhitespacePtr = $phpcsFile->findPrevious(
            [T_WHITESPACE],
            $beforeCommentOrSelfPtr - 1,
            null,
            true
        );
        $previousEchoTokenPtr = false;

        // Token before <?php
        if ($firstNonWhitespacePtr > 0) {
            $previousEchoTokenPtr = $phpcsFile->findPrevious(
                [
                    T_ECHO,
                    T_PRINT
                ],
                $firstNonWhitespacePtr - 1,
                null,
                false,
                null,
                true
            );
        }

        if (($previousEchoTokenPtr === false
                || ($tokens[$previousEchoTokenPtr]['code'] !== T_ECHO
                    && $tokens[$previousEchoTokenPtr]['code'] !== T_PRINT))
            && $tokens[$firstNonWhitespacePtr]['code'] !== T_OPEN_TAG
            && $tokens[$firstNonWhitespacePtr]['code'] !== T_OPEN_CURLY_BRACKET
            && $tokens[$firstNonWhitespacePtr]['code'] !== T_COLON
            && $tokens[$firstNonWhitespacePtr]['code'] !== T_CLOSE_PARENTHESIS
            && $tokens[$firstNonWhitespacePtr]['line'] === $tokens[$beforeCommentOrSelfPtr]['line'] - 1
        ) {
            $data = [$tokens[$stackPtr]['content']];
            $error = 'No blank line found before "%s" or before comment';
            $fix = $phpcsFile->addFixableError($error, $stackPtr, 'BlankLineBefore', $data);

            if ($fix === true) {
                $phpcsFile
                    ->fixer
                    ->beginChangeset();
                $phpcsFile
                    ->fixer
                    ->addNewline($firstNonWhitespacePtr);
                $phpcsFile
                    ->fixer
                    ->endChangeset();
            }
        }

        $semicolonPtr = $phpcsFile->findNext(T_SEMICOLON, $stackPtr + 1, null, false);

        if ($semicolonPtr === false) {
            return;
        }

        $nextNonWhitespacePtr = $phpcsFile->findNext(
            array_merge(
                [T_WHITESPACE],
                \PHP_CodeSniffer_Tokens::$commentTokens
            ),
            $semicolonPtr + 1,
            null,
            true
        );
        $nextCommentOrSelfPtr = $this->getLastCommentOrSelf($phpcsFile, $semicolonPtr + 1);

        if ($tokens[$nextNonWhitespacePtr]['code'] !== T_CLOSE_TAG
            && $tokens[$nextNonWhitespacePtr]['code'] !== T_ECHO
            && $tokens[$nextNonWhitespacePtr]['code'] !== T_BREAK
            && $tokens[$nextNonWhitespacePtr]['code'] !== T_ENDSWITCH
            && $tokens[$nextNonWhitespacePtr]['code'] !== T_DEFAULT
            && $tokens[$nextNonWhitespacePtr]['code'] !== T_CLOSE_CURLY_BRACKET
            && $tokens[$nextNonWhitespacePtr]['code'] !== T_EXIT
            && isset($tokens[$nextCommentOrSelfPtr])
            && $tokens[$nextCommentOrSelfPtr]['line'] + 1 === $tokens[$nextNonWhitespacePtr]['line']
        ) {
            $data = [$tokens[$stackPtr]['content']];
            $error = 'No blank line found after "%s" or after comment';
            $fix = $phpcsFile->addError($error, $stackPtr, 'BlankLineAfter', $data);

            if ($fix === true) {
                $phpcsFile
                    ->fixer
                    ->addNewline($semicolonPtr);
            }
        }
    }

    /**
     * Returns leading comment or self.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile All the tokens found in the document.
     * @param int                  $stackPtr  The position of the current token
     *                                        in the stack passed in $tokens.
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
                $prev - 1,
                null,
                true
            );

            if (in_array($tokens[$newPrev]['code'], \PHP_CodeSniffer_Tokens::$commentTokens)
                && $tokens[$newPrev]['line'] === ($tokens[$prev]['line'] - 1)
            ) {
                $prevTokens[] = $newPrev;
            } else {
                break;
            }
        } while (true);

        return end($prevTokens);
    }

    /**
     * Returns last comment or self.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile All the tokens found in the document.
     * @param int                  $stackPtr  The position of the current token
     *                                        in the stack passed in $tokens.
     *
     * @return bool|int
     */
    protected function getLastCommentOrSelf(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $nextTokens = [$stackPtr];
        $tokens = $phpcsFile->getTokens();

        do {
            $next = end($nextTokens);

            // $next may contain a non-existent position in file
            if (!isset($tokens[$next + 1])) {
                break;
            }

            $newPrev = $phpcsFile->findNext(
                T_WHITESPACE,
                $next + 1,
                null,
                true
            );

            if (in_array($tokens[$newPrev]['code'], \PHP_CodeSniffer_Tokens::$commentTokens)
                && $tokens[$newPrev]['line'] === ($tokens[$next]['line'] + 1)
            ) {
                $nextTokens[] = $newPrev;
            } else {
                break;
            }
        } while (true);

        return end($nextTokens);
    }
}
