<?php
namespace ItgalaxyCodingStandards\Sniffs\Classes;

class PropertiesBeforeMethodsSniff implements \PHP_CodeSniffer_Sniff
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
        return [
            T_CLASS,
            T_TRAIT
        ];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                   $stackPtr  The position of the current token
     *                                         in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $scope = $phpcsFile->findNext(T_FUNCTION, $stackPtr, $tokens[$stackPtr]['scope_closer']);
        $wantedTokens = [
            T_PUBLIC,
            T_PROTECTED,
            T_PRIVATE
        ];

        while ($scope) {
            $scope = $phpcsFile->findNext($wantedTokens, $scope + 1, $tokens[$stackPtr]['scope_closer']);

            if ($scope && $tokens[$scope + 2]['code'] === T_VARIABLE) {
                $phpcsFile->addError(
                    'Declare class and trait properties before methods',
                    $scope,
                    'PropertiesBeforeMethods'
                );
            }
        }
    }
}
