<?php
/**
 * Verify alternative syntax is not being used
 */

namespace ItgalaxyCodingStandards\Sniffs\PHP;

class AlternativeSyntaxSniff implements \PHP_CodeSniffer_Sniff
{
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

    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $error = 'Alternative syntax such as "%s" should not be used';
        $data = [$tokens[$stackPtr]['content']];
        $phpcsFile->addError($error, $stackPtr, 'AlternativeSyntax', $data);
    }
}
