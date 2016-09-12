<?php
namespace ItgalaxyCodingStandards\Sniffs\ControlStructures;

class UnusedVariableInForEachLoopSniff implements \PHP_CodeSniffer_Sniff
{
    /**
     * A list of tokenizers this sniff supports.
     *
     * @var array
     */
    public $supportedTokenizers = ['PHP'];

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_FOREACH];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile All the tokens found in the document.
     * @param int                  $stackPtr  The position of the current token in
     *                                        the stack passed in $tokens.
     *
     * @return void
     */
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        $startTokenPtr = $tokens[$stackPtr]['parenthesis_opener'];
        $endTokenPtr = $tokens[$stackPtr]['parenthesis_closer'];

        $startTokenPtr = $phpcsFile->findNext(T_AS, $startTokenPtr, $endTokenPtr);

        $valueTokenPtr = $phpcsFile->findNext(T_VARIABLE, $startTokenPtr, $endTokenPtr);
        $tmpTokenPtr = $phpcsFile->findNext(T_VARIABLE, $valueTokenPtr + 1, $endTokenPtr);
        // If $tmpToken is not false, the foreach loop uses $key => $value
        $keyTokenPtr = false;

        if ($tmpTokenPtr !== false) {
            $keyTokenPtr = $valueTokenPtr;
            $valueTokenPtr = $tmpTokenPtr;
            unset($tmpToken);
        }

        if (isset($tokens[$stackPtr]['scope_opener'])
            && isset($tokens[$stackPtr]['scope_closer'])
        ) {
            $scopeOpener = $tokens[$stackPtr]['scope_opener'];
            $scopeCloser = $tokens[$stackPtr]['scope_closer'];
        } else {
            // If you are using inline control structure
            $scopeOpener = $endTokenPtr + 1;
            $scopeCloser = $phpcsFile->findEndOfStatement($endTokenPtr) + 1;
        }

        if ($keyTokenPtr !== false
            && !$this->isVariableInsideBlock($phpcsFile, $scopeOpener, $scopeCloser, $keyTokenPtr)
        ) {
            // If a $key is used in foreach loop but not used in the foreach body
            $phpcsFile->addError(
                'The usage of the key variable \'%s\' is not necessary. Please remove this.',
                $stackPtr,
                'KeyVariableNotNecessary',
                [$tokens[$keyTokenPtr]['content']]
            );
        }

        if ($tokens[$valueTokenPtr]['content'] === '$_'
            && $this->isVariableInsideBlock($phpcsFile, $scopeOpener, $scopeCloser, $valueTokenPtr)
        ) {
            // If the $value is named $_ AND used in the foreach body, this variable has to be renamed
            $phpcsFile->addError(
                'The variable \'$_\' is used in the foreach body. '
                    . 'Please rename this variable to a more useful name.',
                $stackPtr,
                'ValueVariableWrongName'
            );
        } elseif ($tokens[$valueTokenPtr]['content'] !== '$_'
            && !$this->isVariableInsideBlock($phpcsFile, $scopeOpener, $scopeCloser, $valueTokenPtr)
        ) {
            // If the $value is NOT named $_, but no one will use this in the foreach body,
            // this variable has to be renamed
            $phpcsFile->addError(
                'The variable \'%s\' is NOT used in the foreach body. Please rename this variable to $_.',
                $stackPtr,
                'ValueVariableNotUsed',
                [$tokens[$valueTokenPtr]['content']]
            );
        }
    }

    protected function isVariableInsideBlock(\PHP_CodeSniffer_File $phpcsFile, $scopeOpener, $scopeCloser, $contentPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $variableName = $tokens[$contentPtr]['content'];

        $isVariableExist = $phpcsFile->findNext(
            T_VARIABLE,
            $scopeOpener + 1,
            $scopeCloser - 1,
            false,
            $variableName
        ) !== false;

        if ($isVariableExist) {
            return true;
        }

        $nextPtr = $scopeOpener + 1;
        $isVariableInsideString = false;

        while (($nextPtr = $phpcsFile->findNext(T_DOUBLE_QUOTED_STRING, $nextPtr + 1, $scopeCloser)) !== false) {
            if (strpos($tokens[$nextPtr]['content'], $variableName) !== false) {
                $isVariableInsideString = true;
            }
        }

        return $isVariableInsideString;
    }
}
