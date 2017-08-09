<?php
namespace ItgalaxyCodingStandards\Sniffs\Security;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Util\Tokens;

class NoInsecurityIncludeSniff implements Sniff
{
    public $allowUrl = false;

    public $allowHasVariable = true;

    /**
     * Pattern to match urls
     *
     * @var string
     */
    public $urlPattern = '#(https?|ftp|ssh2\..*?)://.*#i';

    /**
     * Returns the token types that this sniff is interested in.
     *
     * @return array(int)
     */
    public function register()
    {
        return Tokens::$includeTokens;
    }

    /**
     * Processes the tokens that this sniff is interested in.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file where the token was found.
     * @param int $stackPtr  The position in the stack where the token was found.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        if ($this->allowUrl && $this->allowHasVariable) {
            return;
        }

        $tokens = $phpcsFile->getTokens();
        $nextToken = $phpcsFile->findNext(Tokens::$emptyTokens, $stackPtr + 2, null, true);
        $error = '"%s" statement detected. File manipulations are discouraged.';

        $ignoredTokens = array_merge(Tokens::$emptyTokens, [T_CLOSE_PARENTHESIS]);
        $isUrl = false;
        $hasVariable = false;

        while ($tokens[$nextToken]['code'] !== T_SEMICOLON) {
            switch ($tokens[$nextToken]['code']) {
                case T_CONSTANT_ENCAPSED_STRING:
                    $includePath = trim($tokens[$nextToken]['content'], '"\'');

                    if (preg_match($this->urlPattern, $includePath) === 1) {
                        $isUrl = true;
                    }
                    break;
                case T_VARIABLE:
                    $hasVariable = true;
                    break;
                default:
                    // Nothing
                    break;
            }

            $nextToken = $phpcsFile->findNext($ignoredTokens, $nextToken + 1, null, true);
        }

        $hasError = false;

        if ($isUrl && !$this->allowUrl) {
            $error .= ' Using http, https, ftp and ssh2 wrappers is forbidden.';
            $hasError = true;
        }

        if ($hasVariable && !$this->allowHasVariable) {
            $error .= ' Variables inside are insecure.';
            $hasError = true;
        }

        if (!$hasError) {
            return;
        }

        $phpcsFile->addError($error, $stackPtr, 'IncludeFileDetected', [$tokens[$stackPtr]['content']]);
    }
}
