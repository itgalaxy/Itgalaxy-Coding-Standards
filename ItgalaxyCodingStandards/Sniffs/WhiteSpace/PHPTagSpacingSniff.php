<?php
namespace ItgalaxyCodingStandards\Sniffs\WhiteSpace;

class PHPTagSpacingSniff implements \PHP_CodeSniffer_Sniff
{
    /**
     * Allow newlines instead of spaces.
     *
     * @var boolean
     */
    public $ignoreNewlines = true;

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [
            T_OPEN_TAG,
            T_CLOSE_TAG
        ];
    }

    /**
     * Processes this sniff, when one of its tokens is encountered.
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

        if ($tokens[$stackPtr]['code'] === T_OPEN_TAG) {
            $closeTag = $phpcsFile->findNext(T_CLOSE_TAG, $stackPtr + 1);

            $firstNonWhitespaceAfter = $phpcsFile->findNext(T_WHITESPACE, $stackPtr + 1, null, true);

            if (($tokens[$closeTag]['code'] === T_CLOSE_TAG
                    || $tokens[$firstNonWhitespaceAfter]['code'] !== T_OPEN_TAG)
                && $tokens[$stackPtr]['line'] !== $tokens[$closeTag]['line']
            ) {
                if (strstr($tokens[$stackPtr]['content'], PHP_EOL) === false) {
                    $error = 'Add newline after "<?php" in multiple operators definition (or without close PHP tag)'
                        . 'or cut in one line with close PHP tag';
                    $phpcsFile->addError($error, $stackPtr, 'NoNewlineBeforePHPTagInMultipleDefinition');
                }
            }

            // If next token not close PHP tag, it is not one line expression,
            // it is not one php open tag, first non whitespace token not in same line with open PHP tag
            // line next token not equal first non whitespace token
            if ($tokens[$firstNonWhitespaceAfter]['code'] !== T_CLOSE_TAG
                && $tokens[$stackPtr]['line'] !== $tokens[$closeTag]['line']
                && $tokens[$firstNonWhitespaceAfter]['code'] !== T_OPEN_TAG
                && $tokens[$firstNonWhitespaceAfter]['code'] !== T_NAMESPACE
                && $tokens[$firstNonWhitespaceAfter]['code'] !== T_USE
                && $tokens[$stackPtr]['line'] !== $tokens[$firstNonWhitespaceAfter]['line']
                && $tokens[$stackPtr]['line'] + 1 !== $tokens[$firstNonWhitespaceAfter]['line']
            ) {
                $error = 'No blank lines after open PHP tag';
                $phpcsFile->addError($error, $stackPtr, 'NoBlankLineAfterOpenPHPTag');
            }

            if (isset($tokens[$stackPtr + 1]) && $tokens[$stackPtr + 1]['code'] === T_WHITESPACE) {
                if (isset($tokens[$stackPtr + 2])
                    && $tokens[$stackPtr + 2]['line'] !== $tokens[$stackPtr]['line']
                ) {
                    $found = 'newline';
                } else {
                    $found = $tokens[$stackPtr + 1]['length'];
                }

                $phpcsFile->recordMetric($stackPtr, 'Space after operator', $found);

                if ($found !== 0
                    && ($found !== 'newline' || $this->ignoreNewlines === false)
                ) {
                    if (is_numeric($found)) {
                        $found++;
                    }

                    $error = 'Expected 1 space after "<?php"; %s found';
                    $data = [$found];
                    $phpcsFile->addError($error, $stackPtr, 'SpacingAfter', $data);
                }
            }
        }

        if ($tokens[$stackPtr]['code'] === T_CLOSE_TAG) {
            $openTag = $phpcsFile->findPrevious(
                [
                    T_OPEN_TAG,
                    T_OPEN_TAG_WITH_ECHO
                ],
                $stackPtr - 1
            );

            $emptyTags = false;
            $tokenCounter = $stackPtr - 1;

            while ($tokenCounter >= 0) {
                if ($tokens[$tokenCounter]['code'] === T_OPEN_TAG) {
                    $emptyTags = true;
                    break;
                }

                if ($tokens[$tokenCounter]['code'] !== T_WHITESPACE) {
                    break;
                }

                $tokenCounter--;
            }

            if ($emptyTags) {
                $error = 'Empty php tags are prohibited';
                $phpcsFile->addError($error, $stackPtr, 'EmptyPHPTag');

                return;
            }

            $firstNonWhitespaceBefore = $phpcsFile->findPrevious(T_WHITESPACE, $stackPtr - 1, null, true);

            if ($tokens[$stackPtr]['line'] !== $tokens[$openTag]['line']
                && $tokens[$firstNonWhitespaceBefore]['line'] === $tokens[$stackPtr]['line']
            ) {
                $error = 'Add newline before "?>" in multiple operators definition or cut in one line';
                $phpcsFile->addError($error, $stackPtr, 'NoNewlineAfterPHPTagInMultipleDefinition');
            }

            if ($tokens[$firstNonWhitespaceBefore]['code'] !== T_CLOSE_TAG
                && $tokens[$stackPtr]['line'] !== $tokens[$firstNonWhitespaceBefore]['line']
                && $tokens[$stackPtr]['line'] - 1 !== $tokens[$firstNonWhitespaceBefore]['line']
                && $tokens[$stackPtr]['line'] !== $tokens[$openTag]['line']
            ) {
                $error = 'No blank lines before close PHP tag';
                $phpcsFile->addError($error, $stackPtr, 'NoBlankLineBeforeClosePHPTag');
            }

            $found = null;

            if ($tokens[$stackPtr - 1]['code'] === T_WHITESPACE) {
                if (isset($tokens[$stackPtr - 2])
                    && $tokens[$stackPtr - 2]['line'] !== $tokens[$stackPtr]['line']
                ) {
                    $found = 'newline';
                } else {
                    $found = $tokens[$stackPtr - 1]['length'];
                }
            } else {
                if (in_array($tokens[$stackPtr - 1]['code'], \PHP_CodeSniffer_Tokens::$commentTokens)) {
                    $commentContent = $tokens[$stackPtr - 1]['content'];
                    $found = strlen($commentContent) - strlen(rtrim($commentContent));
                } else {
                    $found = 0;
                }
            }

            $phpcsFile->recordMetric($stackPtr, 'Space before operator', $found);

            if ($found == 1 || ($found === 'newline' && $this->ignoreNewlines === true)) {
                return;
            }

            $error = 'Expected 1 space after "<?php"; %s found';
            $data = [$found];
            $phpcsFile->addError($error, $stackPtr, 'SpacingBefore', $data);
        }
    }
}
