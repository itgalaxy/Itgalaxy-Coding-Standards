<?php
namespace ItgalaxyCodingStandards\Sniffs\WhiteSpace;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class ClassSpacingSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [
            T_CLASS,
            T_INTERFACE,
            T_TRAIT
        ];
    }

    /**
     * Processes this sniff, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param integer $stackPtr The position of the current token in the stack passed in $tokens.
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        // Check the number of blank lines after the class.
        $closer = $tokens[$stackPtr]['scope_closer'];

        // There needs to be 1 blank lines after the closer.
        $nextLineToken = null;

        for ($i = $closer; $i < $phpcsFile->numTokens; $i++) {
            if (strpos($tokens[$i]['content'], $phpcsFile->eolChar) === false) {
                continue;
            } else {
                $nextLineToken = $i + 1;
                break;
            }
        }

        $foundLines = null;

        if ($nextLineToken === null) {
            // Never found the next line, which means
            // there are 0 blank lines after the class.
            $foundLines = 0;
        } else {
            $nextContent = $phpcsFile->findNext([T_WHITESPACE], $nextLineToken + 1, null, true);

            if ($nextContent === false) {
                // We are at the end of the file. That is acceptable as well.
                $foundLines = 1;
            } else {
                $foundLines = ($tokens[$nextContent]['line'] - $tokens[$nextLineToken]['line']);
            }
        }

        if ($foundLines !== 1) {
            $error = 'Expected 1 blank lines after class; %s found';
            $data = [$foundLines];

            if ($foundLines > 0) {
                // Let another sniff worry about too many newlines
                $phpcsFile->addError($error, $closer, 'After', $data);
            } elseif ($foundLines === 0) {
                $fix = $phpcsFile->addFixableError($error, $closer, 'After', $data);

                if ($fix) {
                    $phpcsFile->fixer->addNewline($closer);
                }
            }
        }

        // There needs to be 1 blank lines before the class.
        $prevLineToken = null;

        for ($i = $stackPtr; $i > 0; $i--) {
            if (strpos($tokens[$i]['content'], $phpcsFile->eolChar) === false) {
                continue;
            } else {
                $prevLineToken = $i;
                break;
            }
        }

        if ($prevLineToken === null) {
            // Never found the previous line, which means
            // there are 0 blank lines before the class.
            $foundLines = 0;
        } else {
            $prevContent = $phpcsFile->findPrevious(
                [
                    T_WHITESPACE,
                    T_DOC_COMMENT
                ],
                $prevLineToken,
                null,
                true
            );
            // Before we throw an error, check that we are not throwing an error
            // for another class. We don't want to error for no blank lines after
            // the previous class and no blank lines before this one as well.
            $currentLine = $tokens[$stackPtr]['line'];
            $prevLine = ($tokens[$prevContent]['line'] - 1);
            $i = ($stackPtr - 1);
            $foundLines = 0;

            while ($currentLine !== $prevLine && $currentLine > 1 && $i > 0) {
                if (isset($tokens[$i]['scope_condition']) === true) {
                    $scopeCondition = $tokens[$i]['scope_condition'];

                    if ($tokens[$scopeCondition]['code'] === T_CLASS) {
                        // Found a previous function.
                        return;
                    }
                } elseif ($tokens[$i]['code'] === T_CLASS) {
                    // Found another interface function.
                    return;
                }

                $currentLine = $tokens[$i]['line'];

                if ($currentLine === $prevLine) {
                    break;
                }

                if ($tokens[($i - 1)]['line'] < $currentLine && $tokens[($i + 1)]['line'] > $currentLine) {
                    // This token is on a line by itself. If it is whitespace, the line is empty.
                    if ($tokens[$i]['code'] === T_WHITESPACE) {
                        $foundLines++;
                    }
                }

                $i--;
            }
        }

        if ($foundLines !== 1) {
            $error = 'Expected 1 blank lines before class; %s found';
            $data = [$foundLines];

            if ($foundLines > 0) {
                // Let another sniff worry about too many newlines
                $phpcsFile->addError($error, $stackPtr, 'Before', $data);

                return;
            }

            $phpcsFile->addFixableError($error, $stackPtr, 'Before', $data);

            if ($phpcsFile->fixer->enabled === true) {
                // Find the first token in this line
                $pointer = $stackPtr;

                // Check that there is no doc block in between
                if (!empty($prevContent)) {
                    $comment = $phpcsFile->findNext([T_DOC_COMMENT], $prevContent, $stackPtr);

                    if ($comment) {
                        $pointer = $comment;
                    }
                }

                $token = $pointer;

                while ($tokens[$pointer]['line'] === $tokens[$token]['line']) {
                    $token--;
                }

                $phpcsFile->fixer->addNewlineBefore($token + 1);
            }
        }
    }
}
