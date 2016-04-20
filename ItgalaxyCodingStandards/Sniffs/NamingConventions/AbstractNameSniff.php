<?php
namespace ItgalaxyCodingStandards\Sniffs\NamingConventions;

class AbstractNameSniff implements \PHP_CodeSniffer_Sniff
{
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
     * @param int                  $stackPtr  The position of the current token in
     *                                        the stack passed in $tokens.
     *
     * @return void
     */
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $name = $phpcsFile->findNext(T_STRING, $stackPtr);
        $function = $phpcsFile->findNext(T_FUNCTION, $stackPtr);

        if ($name && ($function === null
                || $name <= $function) && substr($tokens[$name]['content'], 0, 8) != 'Abstract'
        ) {
            $phpcsFile->addError(
                'Abstract class name is not prefixed with "Abstract"',
                $stackPtr,
                'Invalid'
            );
        }
    }
}
