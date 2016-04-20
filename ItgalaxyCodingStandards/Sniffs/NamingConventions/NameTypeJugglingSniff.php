<?php
namespace ItgalaxyCodingStandards\Sniffs\NamingConventions;

class NameTypeJugglingSniff implements \PHP_CodeSniffer_Sniff
{
    public $useShortName = true;

    public $enableRealCast = false;

    public $enableDoubleCast = false;

    public $enableFloatCast = true;

    /**
     * Registers the tokens that this sniff wants to listen for.
     *
     * @return int[]
     */
    public function register()
    {
        return [
            T_BOOL_CAST,
            T_DOUBLE_CAST,
            T_INT_CAST
        ];
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
        $content = $tokens[$stackPtr]['content'];
        $expected = str_replace(' ', '', $content);
        $expected = str_replace("\t", '', $expected);

        if ($tokens[$stackPtr]['code'] === T_BOOL_CAST) {
            if ($expected !== '(bool)' && $this->useShortName) {
                $error = 'A cast statement must be with short name. Instead use `(bool)`.';
                $fix = $phpcsFile->addFixableError($error, $stackPtr, 'NoBooleanLongNameCast');

                if ($fix === true) {
                    $phpcsFile
                        ->fixer
                        ->replaceToken($stackPtr, '(bool)');
                }

                return;
            }

            if ($expected !== '(boolean)' && !$this->useShortName) {
                $error = 'A cast statement must be with long name. Instead use `(boolean)`.';
                $fix = $phpcsFile->addFixableError($error, $stackPtr, 'NoBooleanShortNameCast');

                if ($fix === true) {
                    $phpcsFile
                        ->fixer
                        ->replaceToken($stackPtr, '(boolean)');
                }

                return;
            }
        }

        if ($tokens[$stackPtr]['code'] === T_DOUBLE_CAST) {
            $insteadMessage = '';

            if ($this->enableRealCast
                || $this->enableDoubleCast
                || $this->enableFloatCast
            ) {
                $insteadMessage = 'Instead use';

                if ($this->enableRealCast) {
                    $insteadMessage .= '` (real)`';
                }

                if ($this->enableDoubleCast) {
                    $insteadMessage .= ' `(double)`';
                }

                if ($this->enableFloatCast) {
                    $insteadMessage .= ' `(float)`';
                }
            }

            if ($expected !== '(double)'
                && $expected !== '(float)'
                && !$this->enableRealCast
            ) {
                $error = 'A cast statement must be another type. ' . $insteadMessage;
                $phpcsFile->addError($error, $stackPtr, 'NoRealCastName');

                return;
            }

            if ($expected !== '(real)'
                && $expected !== '(float)'
                && !$this->enableDoubleCast
            ) {
                $error = 'A cast statement must be another type. ' . $insteadMessage;
                $phpcsFile->addError($error, $stackPtr, 'NoDoubleNameCast');

                return;
            }

            if ($expected !== '(real)'
                && $expected !== '(double)'
                && !$this->enableFloatCast
            ) {
                $error = 'A cast statement must be another type. ' . $insteadMessage;
                $phpcsFile->addError($error, $stackPtr, 'NoFloatNameCast');

                return;
            }
        }

        if ($tokens[$stackPtr]['code'] === T_INT_CAST) {
            if ($expected !== '(int)' && $this->useShortName) {
                $error = 'A cast statement must be with short name. Instead use `(int)`.';
                $fix = $phpcsFile->addFixableError($error, $stackPtr, 'NoIntegerLongNameCast');

                if ($fix === true) {
                    $phpcsFile
                        ->fixer
                        ->replaceToken($stackPtr, '(int)');
                }

                return;
            }

            if ($expected !== '(integer)' && !$this->useShortName) {
                $error = 'A cast statement must be with long name. Instead use `(integer)`.';
                $fix = $phpcsFile->addFixableError($error, $stackPtr, 'NoIntegerShortNameCast');

                if ($fix === true) {
                    $phpcsFile
                        ->fixer
                        ->replaceToken($stackPtr, '(integer)');
                }

                return;
            }
        }
    }
}
