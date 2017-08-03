<?php
namespace ItgalaxyCodingStandards\Sniffs\WhiteSpace;

class DoubleColonSpacingSniff implements \PHP_CodeSniffer_Sniff
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
        return [T_DOUBLE_COLON];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                   $stackPtr  The position of the current token
     *                                         in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if ($tokens[$stackPtr - 1]['code'] !== T_WHITESPACE) {
            $before = 0;
        } else {
            if ($tokens[($stackPtr - 2)]['line'] !== $tokens[$stackPtr]['line']) {
                $before = 'newline';
            } else {
                $before = $tokens[$stackPtr - 1]['length'];
            }
        }

        if ($tokens[$stackPtr + 1]['code'] !== T_WHITESPACE) {
            $after = 0;
        } else {
            if ($tokens[$stackPtr + 2]['line'] !== $tokens[$stackPtr]['line']) {
                $after = 'newline';
            } else {
                $after = $tokens[$stackPtr + 1]['length'];
            }
        }
        $phpcsFile->recordMetric($stackPtr, 'Spacing before double colon operator', $before);
        $phpcsFile->recordMetric($stackPtr, 'Spacing after double colon operator', $after);

        $this->checkSpacingBeforeOperator($phpcsFile, $stackPtr, $before);
        $this->checkSpacingAfterOperator($phpcsFile, $stackPtr, $after);
    }

    /**
     * Check the spacing before the operator.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                   $stackPtr  The position of the current token
     *                                         in the stack passed in $tokens.
     * @param mixed                 $before    The number of spaces found before the
     *                                         operator or the string 'newline'.
     *
     * @return boolean true if there was no error, false otherwise.
     */
    protected function checkSpacingBeforeOperator(\PHP_CodeSniffer_File $phpcsFile, $stackPtr, $before)
    {
        if ($before !== 0 && ($before !== 'newline' || $this->ignoreNewlines === false)) {
            $error = 'Space found before double colon operator';
            $fix = $phpcsFile->addFixableError($error, $stackPtr, 'Before');

            if ($fix === true) {
                $phpcsFile->fixer->replaceToken($stackPtr - 1, '');
            }

            return false;
        }
        return true;
    }

    /**
     * Check the spacing after the operator.
     *
     * @param \PHP_CodeSniffer_File       $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token
     *                                               in the stack passed in $tokens.
     * @param mixed                       $after     The number of spaces found after the
     *                                               operator or the string 'newline'.
     *
     * @return boolean true if there was no error, false otherwise.
     */
    protected function checkSpacingAfterOperator(\PHP_CodeSniffer_File $phpcsFile, $stackPtr, $after)
    {
        if ($after !== 0 && ($after !== 'newline' || $this->ignoreNewlines === false)) {
            $error = 'Space found after double colon operator';
            $fix = $phpcsFile->addFixableError($error, $stackPtr, 'After');

            if ($fix === true) {
                $phpcsFile->fixer->replaceToken($stackPtr + 1, '');
            }

            return false;
        }
        return true;
    }
}
