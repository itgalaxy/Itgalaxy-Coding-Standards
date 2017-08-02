<?php
/**
 * CommaSniff.
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */

namespace ItgalaxyCodingStandards\Sniffs\WhiteSpace;

/**
 * CommaSniff.
 *
 * Checks that there is one space after a comma.
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */
class CommaSniff implements \PHP_CodeSniffer_Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_COMMA];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token
     *                                        in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if (isset($tokens[$stackPtr - 1]) !== false) {
            if ($tokens[$stackPtr - 1]['code'] === T_WHITESPACE
                && isset($tokens[$stackPtr - 2]) === true
                && $tokens[$stackPtr - 2]['line'] === $tokens[($stackPtr - 1)]['line']
                && $tokens[$stackPtr - 1]['content'] === ' '
            ) {
                $error = 'Expected no space before the comma, %s found';
                $fix = $phpcsFile->addFixableError(
                    $error,
                    $stackPtr,
                    'NoSpaceBefore',
                    [strlen($tokens[$stackPtr - 1]['content'])]
                );

                if ($fix === true) {
                    $phpcsFile->fixer->replaceToken($stackPtr - 1, '');
                }
            }
        }

        if (isset($tokens[$stackPtr + 1]) !== false) {
            if ($tokens[$stackPtr + 1]['code'] !== T_WHITESPACE
                && $tokens[$stackPtr + 1]['code'] !== T_COMMA
                && $tokens[$stackPtr + 1]['code'] !== T_CLOSE_PARENTHESIS
            ) {
                $error = 'Expected one space after the comma, 0 found';
                $fix = $phpcsFile->addFixableError($error, $stackPtr, 'NoSpaceAfter');

                if ($fix === true) {
                    $phpcsFile->fixer->addContent($stackPtr, ' ');
                }

                return;
            }

            if ($tokens[$stackPtr + 1]['code'] === T_WHITESPACE
                && isset($tokens[$stackPtr + 2]) === true
                && $tokens[$stackPtr + 2]['line'] === $tokens[$stackPtr + 1]['line']
                && $tokens[$stackPtr + 1]['content'] !== ' '
            ) {
                $error = 'Expected one space after the comma, %s found';
                $fix = $phpcsFile->addFixableError(
                    $error,
                    $stackPtr,
                    'TooManySpacesAfter',
                    [strlen($tokens[$stackPtr + 1]['content'])]
                );

                if ($fix === true) {
                    $phpcsFile->fixer->replaceToken($stackPtr + 1, ' ');
                }
            }
        }
    }
}
