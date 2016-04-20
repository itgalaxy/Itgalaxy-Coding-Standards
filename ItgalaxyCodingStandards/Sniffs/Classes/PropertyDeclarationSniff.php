<?php
/**
 * This file is part of the Symfony2-coding-standard (phpcs standard)
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CodeSniffer-Symfony2
 * @author   wicliff wolda <dev@bloody-wicked.com>
 * @license  http://spdx.org/licenses/MIT MIT License
 * @version  GIT: master
 * @link     https://github.com/M6Web/Symfony2-coding-standard
 */
/**
 * Symfony2_Sniffs_Classes_PropertyDeclarationSniff.
 *
 * Throws warnings if properties are declared after methods
 *
 * @category PHP
 * @package  PHP_CodeSniffer-Symfony2
 * @author   wicliff wolda <dev@bloody-wicked.com>
 * @license  http://spdx.org/licenses/MIT MIT License
 * @link     https://github.com/M6Web/Symfony2-coding-standard
 */

namespace ItgalaxyCodingStandards\Sniffs\Classes;

class PropertyDeclarationSniff implements \PHP_CodeSniffer_Sniff
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
    // Todo interface and trait
    public function register()
    {
        return [T_CLASS];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token
     *                                        in the stack passed in $tokens.
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
                    'Declare class properties before methods',
                    $scope,
                    'Invalid'
                );
            }
        }
    }
}
