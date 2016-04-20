<?php
namespace ItgalaxyCodingStandards\Sniffs\Security;

class IncludeFileSniff implements \PHP_CodeSniffer_Sniff
{
    public $allowUrl = false;

    public $allowHasVariable = true;
    /**
     * Pattern to match urls
     *
     * @var string
     */
    public $urlPattern = '#(https?|ftp|ssh2\..*?)://.*#i';

    public function register()
    {
        return \PHP_CodeSniffer_Tokens::$includeTokens;
    }

    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        if ($this->allowUrl && $this->allowHasVariable) {
            return;
        }

        $tokens = $phpcsFile->getTokens();
        $nextToken = $phpcsFile->findNext(\PHP_CodeSniffer_Tokens::$emptyTokens, $stackPtr + 2, null, true);
        $error = '"%s" statement detected. File manipulations are discouraged.';

        $ignoredTokens = array_merge(\PHP_CodeSniffer_Tokens::$emptyTokens, [T_CLOSE_PARENTHESIS]);
        $isConcatenated = false;
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
            $error .= 'Using http, https, ftp and ssh2 wrappers is forbidden.';
            $hasError = true;
        }

        if ($hasVariable && !$this->allowHasVariable) {
            $error .= ' Variables inside are insecure.';
            $hasError = true;
        }

        if ($hasError) {
            $phpcsFile->addError($error, $stackPtr, 'IncludeFileDetected', [$tokens[$stackPtr]['content']]);
        }
    }
}
