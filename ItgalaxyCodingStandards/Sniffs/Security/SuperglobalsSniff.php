<?php
namespace ItgalaxyCodingStandards\Sniffs\Security;

class SuperglobalsSniff implements \PHP_CodeSniffer_Sniff
{
    public $superglobals = [
        '$GLOBALS',
        '$_REQUEST'
    ];

    public function register()
    {
        return [T_VARIABLE];
    }

    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $var = $phpcsFile->getTokens()[$stackPtr]['content'];

        if (in_array($var, $this->superglobals)) {
            $phpcsFile->addError(
                'Forbidden use of %s Superglobal variable.',
                $stackPtr,
                'SuperglobalUsage',
                [$var]
            );
        }
    }
}
