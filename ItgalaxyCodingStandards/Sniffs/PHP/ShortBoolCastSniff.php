<?php
namespace ItgalaxyCodingStandards\Sniffs\PHP;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class ShortBoolCastSniff implements Sniff
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
        return [T_BOOLEAN_NOT];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param integer               $stackPtr  The position of the current token in the
     *                                         stack passed in $tokens.
     * @return void
     */

    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $nextToken = $phpcsFile->findNext(T_WHITESPACE, $stackPtr + 1, null, true);

        if ($tokens[$nextToken]['code'] !== T_BOOLEAN_NOT) {
            return;
        }

        $error = 'Usage of `!!` cast is not allowed.';
        $phpcsFile->addError($error, $stackPtr, 'NoShortBoolCast');

    }
}
