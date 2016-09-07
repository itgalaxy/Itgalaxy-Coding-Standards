<?php
namespace ItgalaxyCodingStandards\Sniffs\NamingConventions;

class InterfaceNamePatternSniff implements \PHP_CodeSniffer_Sniff
{
    public $pattern = '/^[A-Z][A-Za-z0-9]*Interface$/';

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_INTERFACE];
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

        if (!preg_match($this->pattern, $name)) {
            $phpcsFile->addError(
                'Interface does not match the pattern "' . $this->pattern . '"',
                $stackPtr,
                'InvalidInterfaceNamePattern'
            );
        }
    }
}
