<?php
namespace ItgalaxyCodingStandards\Sniffs\Namespaces;

class NamespaceDeclarationSniff implements \PHP_CodeSniffer_Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_NAMESPACE];
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

        if (isset($tokens[$stackPtr + 1]) && $tokens[$stackPtr + 1]['content'] !== ' ') {
            $error = 'There must be exactly one space after the namespace keyword';
            $fix   = $phpcsFile->addFixableError($error, $stackPtr + 1, 'TooManySpacesAfter');

            if ($fix === true) {
                $phpcsFile->fixer->replaceToken($stackPtr + 1, ' ');
            }
        }

        // The $prevFirstTokenOnLine var now points to the first token on the line before the
        // namespace declaration, which must be a blank line.
        for (
            $prevFirstTokenOnLine = ($stackPtr - 1);
            $prevFirstTokenOnLine !== 0;
            $prevFirstTokenOnLine--
        ) {
            if ($tokens[$prevFirstTokenOnLine]['line'] === $tokens[$stackPtr]['line']) {
                continue;
            }

            break;
        }

        $prev = $phpcsFile->findPrevious(T_WHITESPACE, $prevFirstTokenOnLine, 0, true);

        if ($prev !== false) {
            $diffPrev = $tokens[$prevFirstTokenOnLine]['line'] - $tokens[$prev]['line'];

            if ($diffPrev < 0) {
                $diffPrev = 0;
            }

            if ($diffPrev !== 1) {
                $error = 'There must be one blank line before the namespace declaration';
                $fix = $phpcsFile->addFixableError($error, $stackPtr, 'BlankLineBefore');

                if ($fix === true) {
                    if ($diffPrev === 0) {
                        $phpcsFile->fixer->addNewlineBefore($stackPtr);
                    } else {
                        $phpcsFile->fixer->beginChangeset();

                        for ($x = $prevFirstTokenOnLine; $x > $prev; $x--) {
                            if ($tokens[$x]['line'] === $tokens[$stackPtr]['line']) {
                                break;
                            }

                            $phpcsFile->fixer->replaceToken($x, '');
                        }

                        $phpcsFile->fixer->addNewlineBefore($stackPtr);
                        $phpcsFile->fixer->endChangeset();
                    }
                }
            }
        }

        for (
            $nextFirstTokenOnLine = ($stackPtr + 1);
            $nextFirstTokenOnLine < ($phpcsFile->numTokens - 1);
            $nextFirstTokenOnLine++
        ) {
            if ($tokens[$nextFirstTokenOnLine]['line'] === $tokens[$stackPtr]['line']) {
                continue;
            }

            break;
        }

        // The $nextFirstTokenOnLine var now points to the first token on the line after the
        // namespace declaration, which must be a blank line.
        $next = $phpcsFile->findNext(T_WHITESPACE, $nextFirstTokenOnLine, $phpcsFile->numTokens, true);

        if ($next !== false) {
            $diffNext = $tokens[$next]['line'] - $tokens[$nextFirstTokenOnLine]['line'];

            if ($diffNext < 0) {
                $diffNext = 0;
            }

            if ($diffNext !== 1) {
                $error = 'There must be one blank line after the namespace declaration';
                $fix = $phpcsFile->addFixableError($error, $stackPtr, 'BlankLineAfter');

                if ($fix === true) {
                    if ($diffNext === 0) {
                        $phpcsFile->fixer->addNewlineBefore($nextFirstTokenOnLine);
                    } else {
                        $phpcsFile->fixer->beginChangeset();

                        for ($x = $nextFirstTokenOnLine; $x < $next; $x++) {
                            if ($tokens[$x]['line'] === $tokens[$next]['line']) {
                                break;
                            }

                            $phpcsFile->fixer->replaceToken($x, '');
                        }

                        $phpcsFile->fixer->addNewline($nextFirstTokenOnLine);
                        $phpcsFile->fixer->endChangeset();
                    }
                }
            }
        }
    }
}
