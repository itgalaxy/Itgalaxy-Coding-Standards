<?php
namespace ItgalaxyCodingStandards\Sniffs\PHP;

class TypeCastingSniff implements \PHP_CodeSniffer_Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * Note, that this sniff only checks the value and casing of a cast.
     * It does not check for whitespace issues regarding casts, as
     * - Squiz.WhiteSpace.CastSpacing.ContainsWhiteSpace checks for whitespace in the cast
     * - Generic.Formatting.NoSpaceAfterCast.SpaceFound checks for whitespace after the cast
     *
     * @return array
     */
    public function register()
    {
        return array_merge(
            [T_BOOLEAN_NOT],
            \PHP_CodeSniffer_Tokens::$functionNameTokens
        );
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param integer               $stackPtr  The position of the current token in the
     *                                         stack passed in $tokens.
     * @return void
     */

    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if ($tokens[$stackPtr]['code'] === T_STRING) {
            if ($tokens[$stackPtr]['content'] === 'intval') {
                $error = 'Usage of `intval($val)` is not allowed. Please use `(int) $var`.';
                $phpcsFile->addError($error, $stackPtr, 'NotAllowedIntval');
            }

            if ($tokens[$stackPtr]['content'] === 'floatval') {
                $error = 'Usage of `floatval($val)` is not allowed. Please use `(float) $var`.';
                $phpcsFile->addError($error, $stackPtr, 'NotAllowedFloatval');
            }

            if ($tokens[$stackPtr]['content'] === 'doubleval') {
                $error = 'Usage of `doubleval($val)` is not allowed. Please use `(double) $var`.';
                $phpcsFile->addError($error, $stackPtr, 'NotAllowedFloatval');
            }

            if ($tokens[$stackPtr]['content'] === 'strval') {
                $error = 'Usage of `strval($val)` is not allowed. Please use `(string) $var`.';
                $phpcsFile->addError($error, $stackPtr, 'NotAllowedStrval');
            }

            if ($tokens[$stackPtr]['content'] === 'boolval') {
                $error = 'Usage of `boolval($val)` is not allowed. Please use `(bool) $var`.';
                $phpcsFile->addError($error, $stackPtr, 'NotAllowedBoolval');
            }
        } elseif ($tokens[$stackPtr]['code'] === T_BOOLEAN_NOT) {
            $nextToken = $phpcsFile->findNext(T_WHITESPACE, $stackPtr + 1, null, true);

            if ($tokens[$nextToken]['code'] !== T_BOOLEAN_NOT) {
                return;
            }

            $error = 'Usage of `!!` cast is not allowed.';
            $phpcsFile->addError($error, $stackPtr, 'NotAllowedDoubleNot');
        }
    }
}
