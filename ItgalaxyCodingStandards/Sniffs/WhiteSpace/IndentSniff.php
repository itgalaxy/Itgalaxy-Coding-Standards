<?php
namespace ItgalaxyCodingStandards\Sniffs\WhiteSpace;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class IndentSniff implements Sniff
{
    public $indent = 4;

    public function register()
    {
        return [T_OPEN_TAG];
    }

    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $closeTagPtr = $phpcsFile->findNext([T_CLOSE_TAG], $stackPtr, null, false);
        $beforeLine = $tokens[$stackPtr]['line'];

        if ($tokens[$closeTagPtr]['code'] === T_CLOSE_TAG
            && $tokens[$stackPtr]['line'] === $tokens[$closeTagPtr]['line']
        ) {
            return;
        }

        if ($tokens[$closeTagPtr]['code'] !== T_CLOSE_TAG) {
            $closeTagPtr = $phpcsFile->numTokens;
        }

        for ($ptr = $stackPtr + 1; $closeTagPtr - 1 >= $ptr; $ptr++) {
            if ($tokens[$ptr]['line'] === $beforeLine
                || $tokens[$ptr]['code'] === T_WHITESPACE
            ) {
                continue;
            }

            $foundIndent = $tokens[$ptr]['column'] - 1;

            if (($tokens[$ptr]['column'] - 1) % $this->indent !== 0) {
                $data = [
                    $this->indent,
                    $foundIndent
                ];
                $error = 'Indent not correctly; expected multiple of %s or 0 spaces but found %s';
                $phpcsFile->addError($error, $ptr, 'Indent', $data);
            }

            $beforeLine = $tokens[$ptr]['line'];
        }
    }
}
