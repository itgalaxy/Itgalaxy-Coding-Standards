<?php
namespace ItgalaxyCodingStandards\Sniffs\Namespaces;

// Todo respect leading and last comment

class UseDeclarationSniff implements \PHP_CodeSniffer_Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_USE];
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

        if (isset($tokens[$stackPtr + 1])
            && strpos($tokens[$stackPtr + 1]['content'], $phpcsFile->eolChar) === false
            && strlen($tokens[$stackPtr + 1]['content']) > 1
        ) {
            $error = 'There must be exactly one space after the namespace keyword';
            $fix   = $phpcsFile->addFixableError($error, $stackPtr + 1, 'TooManySpacesAfter');

            if ($fix === true) {
                $phpcsFile->fixer->replaceToken($stackPtr + 1, ' ');
            }
        }

        $prevUse = $phpcsFile->findPrevious(T_USE, $stackPtr - 1, 0);

        if ($prevUse === false) {
            for (
                $firstPtrOnPrevLine = ($stackPtr - 1);
                $firstPtrOnPrevLine !== 0;
                $firstPtrOnPrevLine--
            ) {
                if ($tokens[$firstPtrOnPrevLine]['line'] === $tokens[$stackPtr]['line']) {
                    continue;
                }

                break;
            }

            $prevPtr = $phpcsFile->findPrevious(T_WHITESPACE, $firstPtrOnPrevLine, 0, true);

            if ($prevPtr !== false && $tokens[$prevUse]['code'] !== T_USE) {
                $diffPrev = $tokens[$firstPtrOnPrevLine]['line'] - $tokens[$prevPtr]['line'];

                if ($diffPrev < 0) {
                    $diffPrev = 0;
                }

                if ($diffPrev !== 1) {
                    $error = 'There must be one blank line before the use declaration';
                    $fix = $phpcsFile->addFixableError($error, $stackPtr, 'BlankLineBefore');

                    if ($fix === true) {
                        if ($diffPrev === 0) {
                            $phpcsFile->fixer->addNewlineBefore($stackPtr);
                        } else {
                            $phpcsFile->fixer->beginChangeset();

                            for ($x = $firstPtrOnPrevLine; $x > $prevPtr; $x--) {
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
        }

        $nextUse = $phpcsFile->findNext(T_USE, $stackPtr + 1, $phpcsFile->numTokens);

        if ($nextUse === false) {
            $semicolonPtr = $phpcsFile->findNext(T_SEMICOLON, $stackPtr + 1, $phpcsFile->numTokens);

            for (
                $firstPtrOnNextFile = ($semicolonPtr + 1);
                $firstPtrOnNextFile < ($phpcsFile->numTokens - 1);
                $firstPtrOnNextFile++
            ) {
                if ($tokens[$firstPtrOnNextFile]['line'] === $tokens[$semicolonPtr]['line']) {
                    continue;
                }

                break;
            }

            $nextPtr = $phpcsFile->findNext(T_WHITESPACE, $firstPtrOnNextFile, $phpcsFile->numTokens, true);

            if ($nextPtr !== false) {
                $diffNext = $tokens[$nextPtr]['line'] - $tokens[$firstPtrOnNextFile]['line'];

                if ($diffNext < 0) {
                    $diffNext = 0;
                }

                if ($diffNext !== 1) {
                    $error = 'There must be one blank line after the use declaration';
                    $fix = $phpcsFile->addFixableError($error, $stackPtr, 'BlankLineAfter');

                    if ($fix === true) {
                        if ($diffNext === 0) {
                            $phpcsFile->fixer->addNewlineBefore($firstPtrOnNextFile);
                        } else {
                            $phpcsFile->fixer->beginChangeset();

                            for ($x = $firstPtrOnNextFile; $x < $nextPtr; $x++) {
                                if ($tokens[$x]['line'] === $tokens[$nextPtr]['line']) {
                                    break;
                                }

                                $phpcsFile->fixer->replaceToken($x, '');
                            }

                            $phpcsFile->fixer->addNewline($firstPtrOnNextFile);
                            $phpcsFile->fixer->endChangeset();
                        }
                    }
                }
            }
        }
    }
}
