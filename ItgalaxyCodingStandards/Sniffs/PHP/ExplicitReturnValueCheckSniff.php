<?php
namespace ItgalaxyCodingStandards\Sniffs\PHP;

class ExplicitReturnValueCheckSniff implements \PHP_CodeSniffer_Sniff
{
    public $functions = [
        'preg_match',
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
        'file_get_contents',
        'file_put_contents',
        'fgetc',
        'mb_strlen',
        'imagecolorallocatealpha',
        'imagecolorallocate',
        'simplexml_import_dom',
        'simplexml_load_file',
        'simplexml_load_string',
        'curl_exec',
        'pcntl-getpriority',
        'readdir'
    ];

    protected $identicalOperators = [
        T_IS_IDENTICAL,
        T_IS_NOT_IDENTICAL
    ];

    public function register()
    {
        return [T_IF];
    }

    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $open = $tokens[$stackPtr]['parenthesis_opener'];
        $close = $tokens[$stackPtr]['parenthesis_closer'];
        $foundFunction = false;
        $foundIdentityOperator = false;
        $foundFunctionName = '';

        for ($i = $open + 1; $i < $close; $i++) {
            if ($tokens[$i]['code'] === T_STRING && in_array($tokens[$i]['content'], $this->functions)) {
                $foundFunction = true;
                $foundFunctionName = $tokens[$i]['content'];
            } elseif ($tokens[$i]['code'] === T_IS_IDENTICAL
                || $tokens[$i]['code'] === T_IS_NOT_IDENTICAL
            ) {
                $foundIdentityOperator = true;
            }
        }

        if ($foundFunction && !$foundIdentityOperator) {
            $phpcsFile->addError(
                'Identical operator === is not used for testing the return value of %s function. '
                . 'Use `$value = %s(...arguments); '
                . 'if ($value === false) { // Logic } else { // Logic }` '
                . 'or `$value = %s(...arguments); '
                . 'if ($value !== false) { // Logic } else { // Logic }`',
                $stackPtr,
                'ImproperValueTesting',
                [
                    $foundFunctionName,
                    $foundFunctionName,
                    $foundFunctionName
                ]
            );
        }
    }
}
