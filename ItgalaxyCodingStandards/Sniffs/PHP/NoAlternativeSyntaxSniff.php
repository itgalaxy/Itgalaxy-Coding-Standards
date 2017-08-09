<?php
namespace ItgalaxyCodingStandards\Sniffs\PHP;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class NoAlternativeSyntaxSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [
            T_ENDDECLARE,
            T_ENDFOR,
            T_ENDFOREACH,
            T_ENDIF,
            T_ENDSWITCH,
            T_ENDWHILE
        ];
    }

    /**
     * Processes this sniff, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                   $stackPtr  The position of the current token in
     *                                         the stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        $phpcsFile->addError(
            'Alternative syntax such as "%s" should not be used',
            $stackPtr,
            'NoAlternativeSyntax',
            [$tokens[$stackPtr]['content']]
        );
    }
}
