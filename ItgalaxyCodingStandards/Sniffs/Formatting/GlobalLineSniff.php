<?php
namespace ItgalaxyCodingStandards\Sniffs\Formatting;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Util\Tokens;

class GlobalLineSniff implements Sniff
{
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
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if ($tokens[$stackPtr + 1]['code'] !== T_WHITESPACE) {
            $error = 'Expected one space after global keyword, 0 found';
            $fix = $phpcsFile->addFixableError($error, $stackPtr, 'NoSpaceAfterGlobal');

            if ($fix === true) {
                $phpcsFile
                    ->fixer
                    ->addContent($stackPtr, ' ');
            }
        }

        $spacesAfterGlobal = 0;
        $nextPtr = $stackPtr + 1;
        $nonWhitespaceTokenPtr = $phpcsFile->findNext(
            array_merge(
                [T_WHITESPACE],
                Tokens::$commentTokens
            ),
            $nextPtr,
            null,
            true
        );
        $foundNewline = false;
        $countNewlines = 0;

        for ($i = $nextPtr; $i < $nonWhitespaceTokenPtr; $i++) {
            if ($tokens[$i]['content'] === $phpcsFile->eolChar) {
                $foundNewline = true;
                $countNewlines++;
            } else {
                $spacesAfterGlobal += strlen($tokens[$i]['content']);
            }
        }

        if ($tokens[$stackPtr + 1]['code'] === T_WHITESPACE
            && ($foundNewline == false
                && $spacesAfterGlobal > 1)
            || ($foundNewline
                && $countNewlines > 1)
        ) {
            $error = 'Expected one space or one newline after global keyword, %s spaces and %s newlines found';
            $phpcsFile->addError(
                $error,
                $stackPtr,
                'TooManySpacesAfterGlobal',
                [
                    $spacesAfterGlobal,
                    $countNewlines
                ]
            );
        }

        $beforeCommentOrSelfPtr = $this->getLeadingCommentOrSelf($phpcsFile, $stackPtr);
        $firstNonWhitespacePtr = $phpcsFile->findPrevious(
            [T_WHITESPACE],
            $beforeCommentOrSelfPtr - 1,
            null,
            true
        );
        $previousGlobalTokenPtr = false;

        // Token before <?php
        if ($firstNonWhitespacePtr > 0) {
            $previousGlobalTokenPtr = $phpcsFile->findPrevious(
                [T_GLOBAL],
                $firstNonWhitespacePtr - 1,
                null,
                false,
                null,
                true
            );
        }

        if (($previousGlobalTokenPtr === false
                || $tokens[$previousGlobalTokenPtr]['code'] !== T_GLOBAL)
            && $tokens[$firstNonWhitespacePtr]['code'] !== T_OPEN_TAG
            && $tokens[$firstNonWhitespacePtr]['code'] !== T_OPEN_CURLY_BRACKET
            && $tokens[$firstNonWhitespacePtr]['code'] !== T_COLON
            && $tokens[$firstNonWhitespacePtr]['line'] === $tokens[$beforeCommentOrSelfPtr]['line'] - 1
        ) {
            $data = [$tokens[$stackPtr]['content']];
            $error = 'No blank line found before "%s" or before comment';
            $fix = $phpcsFile->addFixableError($error, $stackPtr, 'NoBlankLineBefore', $data);

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
        $nextNonWhitespacePtr = $phpcsFile->findNext(
            array_merge(
                [T_WHITESPACE],
                Tokens::$commentTokens
            ),
            $semicolonPtr + 1,
            null,
            true
        );
        $nextCommentOrSelfPtr = $this->getLastCommentOrSelf($phpcsFile, $semicolonPtr + 1);

        if ($tokens[$nextNonWhitespacePtr]['code'] !== T_CLOSE_TAG
            && $tokens[$nextNonWhitespacePtr]['code'] !== T_GLOBAL
            && $tokens[$nextNonWhitespacePtr]['code'] !== T_BREAK
            && $tokens[$nextNonWhitespacePtr]['code'] !== T_DEFAULT
            && $tokens[$nextNonWhitespacePtr]['code'] !== T_CLOSE_CURLY_BRACKET
            && isset($tokens[$nextCommentOrSelfPtr])
            && $tokens[$nextCommentOrSelfPtr]['line'] + 1 === $tokens[$nextNonWhitespacePtr]['line']
        ) {
            $data = [$tokens[$stackPtr]['content']];
            $error = 'No blank line found after "%s" or after comment';
            $fix = $phpcsFile->addFixableError($error, $stackPtr, 'NoBlankLineAfter', $data);

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
    protected function getLeadingCommentOrSelf(File $phpcsFile, $stackPtr)
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

            if (in_array($tokens[$newPrev]['code'], Tokens::$commentTokens)
                && $tokens[$newPrev]['line'] === $tokens[$prev]['line'] - 1
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
    protected function getLastCommentOrSelf(File $phpcsFile, $stackPtr)
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

            if (in_array($tokens[$newPrev]['code'], Tokens::$commentTokens)
                && $tokens[$newPrev]['line'] === $tokens[$next]['line'] + 1
            ) {
                $nextTokens[] = $newPrev;
            } else {
                break;
            }
        } while (true);

        return end($nextTokens);
    }
}
