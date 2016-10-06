<?php
namespace ItgalaxyCodingStandards\Sniffs\NamingConventions;

class TraitNamePatternSniff implements \PHP_CodeSniffer_Sniff
{
    public $pattern = '/^[A-Z][A-Za-z0-9]*Trait$/';

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * If the constant is not defined, ignore because probably the PHP version
     * is under 5.4.0 and don't have traits in use
     *
     * @return array
     */
    public function register()
    {
        return [T_TRAIT];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param integer $stackPtr  The position of the current token in the stack passed in $tokens.
     * @return void
     */
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $name = $phpcsFile->getDeclarationName($stackPtr);

        if (preg_match($this->pattern, $name) === 0) {
            $phpcsFile->addError(
                'Trait does not match the pattern "' . $this->pattern . '"',
                $stackPtr,
                'TraitNamePattern'
            );
        }
    }
}
