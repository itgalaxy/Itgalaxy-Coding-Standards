<?php
namespace ItgalaxyCodingStandards\Sniffs\Files;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class FileNameSniff implements Sniff
{
    public $pattern = '/^[A-Za-z0-9-\.]*$/';

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_OPEN_TAG];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                   $stackPtr  The position of the current token in the
     *                                         stack passed in $tokens.
     *
     * @return int
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $fileName = basename($phpcsFile->getFileName());

        if (preg_match($this->pattern, $fileName) === 0) {
            $error = 'File name "' . $fileName . '" does not match the pattern use "' . $this->pattern . '"';
            $phpcsFile->addError($error, $stackPtr, 'FileNamePattern');
        }

        return $phpcsFile->numTokens + 1;
    }
}
