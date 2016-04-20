<?php
namespace ItgalaxyCodingStandards\Sniffs\NamingConventions;

class ExceptionNameSniff implements \PHP_CodeSniffer_Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_CLASS];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token in
     *                                        the stack passed in $tokens.
     *
     * @return void
     */
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $name = $phpcsFile->getDeclarationName($stackPtr);
        $extendedClassName = $phpcsFile->findExtendedClassName($stackPtr);

        if (substr($extendedClassName, -9) === 'Exception'
            && substr($name, -9) !== 'Exception'
        ) {
            $warn = 'Exception names should always have the suffix "Exception"';
            $phpcsFile->addError($warn, $stackPtr, 'InvalidExceptionName');
        }
    }
}
