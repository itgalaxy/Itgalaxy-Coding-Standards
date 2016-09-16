<?php
namespace ItgalaxyCodingStandards\Sniffs\NamingConventions;

class AbstractNameSniff implements \PHP_CodeSniffer_Sniff
{
    public $pattern = '/^[A-Z][A-Za-z0-9]*Abstract$/';

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_ABSTRACT];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                   $stackPtr  The position of the current token in
     *                                        the stack passed in $tokens.
     *
     * @return void
     */
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $name = $phpcsFile->findNext(T_STRING, $stackPtr);
        $function = $phpcsFile->findNext(T_FUNCTION, $stackPtr);

        if ($name && ($function === null || $name <= $function)
            && preg_match($this->pattern, $tokens[$name]['content']) === 0
        ) {
            $phpcsFile->addError(
                'Abstract class does not match the pattern "' . $this->pattern . '"',
                $stackPtr,
                'InvalidAbstractNamePattern'
            );
        }
    }
}
