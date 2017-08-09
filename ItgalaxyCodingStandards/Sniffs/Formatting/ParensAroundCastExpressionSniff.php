<?php
namespace ItgalaxyCodingStandards\Sniffs\Formatting;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Util\Tokens;

class ParensAroundCastExpressionSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return Tokens::$castTokens;
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
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $next = $phpcsFile->findNext(T_WHITESPACE, $stackPtr + 1, null, true);

        if ($tokens[$next]['code'] !== T_OPEN_PARENTHESIS || !isset($tokens[$next]['parenthesis_opener'])) {
            return;
        }

        if (!$this->hasOneNotEmptyTokenInParens(
            $phpcsFile,
            $tokens[$next]['parenthesis_opener'],
            $tokens[$next]['parenthesis_closer']
        )) {
            return;
        }

        $phpcsFile->addError('Do not use parenthesis around expression in type casting', $stackPtr, 'Found');
    }

    protected function hasOneNotEmptyTokenInParens(File $phpcsFile, $opener, $closer)
    {
        $tokens = $phpcsFile->getTokens();
        $hasOneNotEmptyTokenInParens = true;
        $count = 0;

        for ($nextPtr = $opener + 1; $nextPtr < $closer; $nextPtr++) {
            if (!in_array($tokens[$nextPtr]['code'], Tokens::$emptyTokens)) {
                $count++;
            }

            if ($count > 1) {
                $hasOneNotEmptyTokenInParens = false;
                break;
            }
        }

        return $hasOneNotEmptyTokenInParens;
    }
}
