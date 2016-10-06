<?php
namespace ItgalaxyCodingStandards\Sniffs\WhiteSpace;

class ObjectOperatorSpacingSniff implements \PHP_CodeSniffer_Sniff
{
    /**
     * Allow newlines before object operator.
     *
     * @var boolean
     */
    public $ignoreNewlinesBefore = true;

    /**
     * Allow newlines after object operator.
     *
     * @var boolean
     */
    public $ignoreNewlinesAfter = false;

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_OBJECT_OPERATOR];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile All the tokens found in the document.
     * @param int                  $stackPtr  The position of the current token
     *                                        in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if ($tokens[($stackPtr - 1)]['code'] !== T_WHITESPACE) {
            $before = 0;
        } else {
            if ($tokens[($stackPtr - 2)]['line'] !== $tokens[$stackPtr]['line']) {
                $before = 'newline';
            } else {
                $before = $tokens[($stackPtr - 1)]['length'];
            }
        }

        if ($tokens[($stackPtr + 1)]['code'] !== T_WHITESPACE) {
            $after = 0;
        } else {
            if ($tokens[($stackPtr + 2)]['line'] !== $tokens[$stackPtr]['line']) {
                $after = 'newline';
            } else {
                $after = $tokens[($stackPtr + 1)]['length'];
            }
        }

        $phpcsFile->recordMetric($stackPtr, 'Spacing before object operator', $before);
        $phpcsFile->recordMetric($stackPtr, 'Spacing after object operator', $after);

        if ($before !== 0) {
            $errorBefore = true;

            if ($before === 'newline' && $this->ignoreNewlinesBefore) {
                $errorBefore = false;
            }

            if ($errorBefore) {
                $fix = $phpcsFile->addFixableError('Space found before object operator', $stackPtr, 'Before');

                if ($fix === true) {
                    $phpcsFile->fixer->replaceToken(($stackPtr - 1), '');
                }
            }
        }

        if ($after !== 0) {
            $errorAfter = true;

            if ($after === 'newline' && $this->ignoreNewlinesAfter) {
                $errorAfter = false;
            }

            if ($errorAfter) {
                $fix = $phpcsFile->addFixableError('Space found after object operator', $stackPtr, 'After');

                if ($fix === true) {
                    $phpcsFile->fixer->replaceToken(($stackPtr + 1), '');
                }
            }
        }
    }
}
