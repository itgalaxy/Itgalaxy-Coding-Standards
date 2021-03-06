<?php
namespace ItgalaxyCodingStandards\Sniffs\Classes;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class ScopeMethodsOrderSniff implements Sniff
{
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
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $function = $stackPtr;
        $scopes = [
            0 => T_PUBLIC,
            1 => T_PROTECTED,
            2 => T_PRIVATE
        ];
        $whitelist = ['__construct'];

        while ($function) {
            $function = $phpcsFile->findNext(T_FUNCTION, $function + 1, $tokens[$stackPtr]['scope_closer']);

            if (!isset($tokens[$function]['parenthesis_opener'])) {
                continue;
            }

            $scope = $phpcsFile->findPrevious($scopes, $function - 1, $stackPtr);
            $name = $phpcsFile->findNext(T_STRING, $function + 1, $tokens[$function]['parenthesis_opener']);

            if ($scope && $name && !in_array($tokens[$name]['content'], $whitelist)) {
                $current = array_keys($scopes, $tokens[$scope]['code']);

                $current = $current[0];

                if (isset($previous) && $current < $previous) {
                    $phpcsFile->addError(
                        'Declare public methods first, then protected ones and finally private ones',
                        $scope,
                        'InvalidScopeMethodOrder'
                    );
                }

                $previous = $current;
            }
        }
    }
}
