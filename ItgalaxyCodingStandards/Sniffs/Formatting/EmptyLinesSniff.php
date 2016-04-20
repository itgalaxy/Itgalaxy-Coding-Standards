<?php
/**
 * Drupal_Sniffs_WhiteSpace_EmptyLinesSniff.
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @author   Klaus Purer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */

/**
 * Drupal_Sniffs_WhiteSpace_EmptyLinesSniff.
 *
 * Checks that there are not more than 2 empty lines following each other.
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @author   Klaus Purer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */

namespace ItgalaxyCodingStandards\Sniffs\Formatting;

class EmptyLinesSniff implements \PHP_CodeSniffer_Sniff
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
        return [T_WHITESPACE];
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

        if ($tokens[$stackPtr]['content'] === $phpcsFile->eolChar
            && isset($tokens[$stackPtr + 1]) === true
            && $tokens[$stackPtr + 1]['content'] === $phpcsFile->eolChar
            && isset($tokens[$stackPtr + 2]) === true
            && $tokens[$stackPtr + 2]['content'] === $phpcsFile->eolChar
        ) {
            $error = 'More than 1 empty lines are not allowed';
            $fix = $phpcsFile->addFixableError($error, $stackPtr + 1, 'EmptyLines');

            if ($fix === true) {
                $phpcsFile
                    ->fixer
                    ->replaceToken(($stackPtr + 1), '');
            }
        }
    }
}
