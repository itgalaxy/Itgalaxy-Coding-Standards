<?php
namespace ItgalaxyCodingStandards\Sniffs\NamingConventions;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class FloatFormTypeKeywordSniff implements Sniff
{
    public $real = false;

    public $double = false;

    public $float = true;

    /**
     * Registers the tokens that this sniff wants to listen for.
     *
     * @return int[]
     */
    public function register()
    {
        return [
            T_DOUBLE_CAST
        ];
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
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $content = $tokens[$stackPtr]['content'];
        $expected = str_replace(' ', '', $content);
        $expected = str_replace("\t", '', $expected);

        if ($tokens[$stackPtr]['code'] === T_DOUBLE_CAST) {
            $insteadMessage = '';

            if ($this->real || $this->double || $this->float) {
                $insteadMessage = 'Instead use';

                if ($this->real) {
                    $insteadMessage .= '` (real)`';
                }

                if ($this->double) {
                    $insteadMessage .= ' `(double)`';
                }

                if ($this->float) {
                    $insteadMessage .= ' `(float)`';
                }
            }

            if ($expected !== '(double)'
                && $expected !== '(float)'
                && !$this->real
            ) {
                $error = 'A cast statement must be another type. ' . $insteadMessage;
                $phpcsFile->addError($error, $stackPtr, 'NoRealNameCast');

                return;
            }

            if ($expected !== '(real)'
                && $expected !== '(float)'
                && !$this->double
            ) {
                $error = 'A cast statement must be another type. ' . $insteadMessage;
                $phpcsFile->addError($error, $stackPtr, 'NoDoubleNameCast');

                return;
            }

            if ($expected !== '(real)'
                && $expected !== '(double)'
                && !$this->float
            ) {
                $error = 'A cast statement must be another type. ' . $insteadMessage;
                $phpcsFile->addError($error, $stackPtr, 'NoFloatNameCast');

                return;
            }
        }
    }
}
