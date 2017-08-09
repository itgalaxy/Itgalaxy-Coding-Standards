<?php
namespace ItgalaxyCodingStandards\Sniffs\Strings;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class EmbeddedVariablesSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_DOUBLE_QUOTED_STRING];
    }

    /**
     * Returns leading comment or self.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile All the tokens found in the document.
     * @param int                   $stackPtr  The position of the current token
     *                                         in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        // We are only interested in the first token in a multi-line string.
        if ($tokens[$stackPtr]['code'] === $tokens[$stackPtr - 1]['code']) {
            return;
        }

        $workingString = $tokens[$stackPtr]['content'];

        for ($i = $stackPtr + 1; $tokens[$i]['code'] === $tokens[$stackPtr]['code']; ++$i) {
            $workingString .= $tokens[$i]['content'];
        }

        $openBraces = 0;
        $foundVariable = false;

        foreach (token_get_all('<?php ' . $workingString) as $token) {
            if (is_array($token) === true) {
                if ($token[0] === T_CURLY_OPEN) {
                    ++$openBraces;
                } elseif ($token[0] === T_VARIABLE) {
                    $foundVariable = true;

                    if ($openBraces < 1) {
                        $phpcsFile->addError(
                            'String %s has a variable embedded without being delimited by braces',
                            $stackPtr,
                            'ContainsNonDelimitedVariable',
                            [$workingString]
                        );
                    }
                }
            } elseif ($token === '}' && $foundVariable) {
                --$openBraces;
                $foundVariable = false;
            }
        }
    }
}
