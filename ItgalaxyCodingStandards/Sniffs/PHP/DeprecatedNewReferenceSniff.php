<?php
namespace ItgalaxyCodingStandards\Sniffs\PHP;

class DeprecatedNewReferenceSniff implements \PHP_CodeSniffer_Sniff
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
        return [T_NEW];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param integer              $stackPtr  The position of the current token in the
     *                                        stack passed in $tokens.
     * @return void
     */
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if ($tokens[$stackPtr - 1]['code'] === T_BITWISE_AND
            || $tokens[$stackPtr - 2]['code'] === T_BITWISE_AND
        ) {
            $error = 'Assigning the return value of new by reference is deprecated in PHP 5.3';
            $phpcsFile->addError($error, $stackPtr);
        }
    }
}
