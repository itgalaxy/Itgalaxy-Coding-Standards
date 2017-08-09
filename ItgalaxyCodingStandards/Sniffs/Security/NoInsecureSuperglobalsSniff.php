<?php
namespace ItgalaxyCodingStandards\Sniffs\Security;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class NoInsecureSuperglobalsSniff implements Sniff
{
    public $superglobals = [
        '$GLOBALS',
        '$_REQUEST'
    ];

    /**
     * Returns the token types that this sniff is interested in.
     *
     * @return array(int)
     */
    public function register()
    {
        return [T_VARIABLE];
    }

    /**
     * Processes the tokens that this sniff is interested in.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file where the token was found.
     * @param int                   $stackPtr  The position in the stack where
     *                                         the token was found.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $var = $phpcsFile->getTokens()[$stackPtr]['content'];

        if (!in_array($var, $this->superglobals)) {
            return;
        }

        $phpcsFile->addError(
            'Forbidden use of %s Superglobal variable.',
            $stackPtr,
            'SuperglobalUsage',
            [$var]
        );
    }
}
