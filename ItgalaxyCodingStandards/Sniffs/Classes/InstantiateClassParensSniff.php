<?php
namespace ItgalaxyCodingStandards\Sniffs\Classes;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class InstantiateClassParensSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_NEW];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                   $stackPtr  The position of the current token in the
     *                                         stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $allowed = [
            T_STRING,
            T_NS_SEPARATOR,
            T_VARIABLE,
            T_STATIC,
            T_DOUBLE_COLON
        ];

        $object = $stackPtr;
        $line = $tokens[$object]['line'];

        while ($object && $tokens[$object]['line'] === $line) {
            $object = $phpcsFile->findNext($allowed, $object + 1);

            if ($tokens[$object]['line'] === $line
                && !in_array($tokens[$object + 1]['code'], $allowed)
            ) {
                if ($tokens[$object + 1]['code'] !== T_OPEN_PARENTHESIS) {
                    $phpcsFile->addError(
                        'Use parentheses when instantiating class',
                        $stackPtr,
                        'InstantiateClassParensSniff'
                    );
                }

                break;
            }
        }
    }
}
