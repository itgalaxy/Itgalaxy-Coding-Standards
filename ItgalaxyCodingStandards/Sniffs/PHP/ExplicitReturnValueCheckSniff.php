<?php
namespace ItgalaxyCodingStandards\Sniffs\PHP;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class ExplicitReturnValueCheckSniff implements Sniff
{
    public $functions = [
        'array_search',
        'strpos',
        'strrpos',
        'stripos',
        'strripos',
        'strtok',
        'iconv_strpos',
        'iconv_strrpos',
        'mb_strlen',
        'prev',
        'current',
        'next',
        'iconv_strrpos',
        'fgetc',
        'mb_strlen'
    ];

    public $allowedComparisonTokens = [
        T_IS_IDENTICAL,
        T_IS_NOT_IDENTICAL,
        T_LESS_THAN,
        T_IS_SMALLER_OR_EQUAL,
        T_GREATER_THAN,
        T_IS_GREATER_OR_EQUAL
    ];

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_IF];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                   $stackPtr  The position of the current token in the
     *                                         stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $open = $tokens[$stackPtr]['parenthesis_opener'];
        $close = $tokens[$stackPtr]['parenthesis_closer'];
        $foundFunction = false;
        $foundOperator = false;
        $foundFunctionName = '';

        for ($i = $open + 1; $i < $close; $i++) {
            if ($tokens[$i]['code'] === T_STRING && in_array($tokens[$i]['content'], $this->functions)) {
                $foundFunction = true;
                $foundFunctionName = $tokens[$i]['content'];
            } elseif (in_array($tokens[$i]['code'], $this->allowedComparisonTokens)) {
                $foundOperator = true;
            }
        }

        if ($foundFunction && !$foundOperator) {
            $phpcsFile->addError(
                'Identical operator === is not used for testing the return value of %s function',
                $stackPtr,
                'Found',
                [$foundFunctionName]
            );
        }
    }
}
