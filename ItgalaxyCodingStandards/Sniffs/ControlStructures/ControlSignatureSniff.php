<?php
namespace ItgalaxyCodingStandards\Sniffs\ControlStructures;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Util\Tokens;

class ControlSignatureSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return int[]
     */
    public function register()
    {
        return [
            T_TRY,
            T_CATCH,
            T_DO,
            T_WHILE,
            T_FOR,
            T_IF,
            T_FOREACH,
            T_ELSE,
            T_ELSEIF,
            T_SWITCH,
            T_FINALLY
        ];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token in the
     *                                        stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if (isset($tokens[$stackPtr + 1]) === false) {
            return;
        }

        // Single space after the keyword.
        $found = 1;

        if ($tokens[$stackPtr + 1]['code'] !== T_WHITESPACE) {
            $found = 0;
        } elseif ($tokens[$stackPtr + 1]['content'] !== ' ') {
            if (strpos($tokens[$stackPtr + 1]['content'], $phpcsFile->eolChar) !== false) {
                $found = 'newline';
            } else {
                $found = strlen($tokens[$stackPtr + 1]['content']);
            }
        }

        if ($found !== 1) {
            $error = 'Expected 1 space after %s keyword; %s found';
            $data = [
                strtoupper($tokens[$stackPtr]['content']),
                $found
            ];
            $fix = $phpcsFile->addFixableError($error, $stackPtr, 'SpaceAfterKeyword', $data);

            if ($fix === true) {
                if ($found === 0) {
                    $phpcsFile->fixer->addContent($stackPtr, ' ');
                } else {
                    $phpcsFile->fixer->replaceToken($stackPtr + 1, ' ');
                }
            }
        }

        // Single space after closing parenthesis.
        if (isset($tokens[$stackPtr]['parenthesis_closer']) === true
            && isset($tokens[$stackPtr]['scope_opener']) === true
        ) {
            $closer = $tokens[$stackPtr]['parenthesis_closer'];
            $opener = $tokens[$stackPtr]['scope_opener'];
            $content = $phpcsFile->getTokensAsString($closer + 1, $opener - $closer - 1);

            if ($content !== ' ') {
                $error = 'Expected 1 space after closing parenthesis; found %s';

                if ($tokens[$closer + 1]['code'] !== T_WHITESPACE) {
                    $found = 0;
                } else {
                    if (strpos($content, $phpcsFile->eolChar) !== false) {
                        $found = 'newline';
                    } else {
                        $found = strlen($content);
                    }
                }

                $fix = $phpcsFile->addFixableError($error, $closer, 'SpaceAfterCloseParenthesis', [$found]);

                if ($fix === true) {
                    if ($closer === ($opener - 1)) {
                        $phpcsFile->fixer->addContent($closer, ' ');
                    } else {
                        $phpcsFile->fixer->beginChangeset();

                        if (trim($content) === '') {
                            $phpcsFile->fixer->addContent($closer, ' ');

                            if ($found !== 0) {
                                for ($i = $closer + 1; $i < $opener; $i++) {
                                    $phpcsFile->fixer->replaceToken($i, '');
                                }
                            }
                        } else {
                            $phpcsFile->fixer->addContent($closer, ' ' . $tokens[$opener]['content']);
                            $phpcsFile->fixer->replaceToken($opener, '');

                            if ($tokens[$opener]['line'] !== $tokens[$closer]['line']) {
                                $next = $phpcsFile->findNext(T_WHITESPACE, ($opener + 1), null, true);

                                if ($tokens[$next]['line'] !== $tokens[$opener]['line']) {
                                    for ($i = $opener + 1; $i < $next; $i++) {
                                        $phpcsFile->fixer->replaceToken($i, '');
                                    }
                                }
                            }
                        }

                        $phpcsFile->fixer->endChangeset();
                    }
                }
            }
        }

        // Single newline before closing brace.
        if (isset($tokens[$stackPtr]['scope_closer']) === true) {
            $closer = $tokens[$stackPtr]['scope_closer'];

            for ($prev = $closer - 1; $prev > 0; $prev--) {
                $code = $tokens[$prev]['code'];

                if ($code === T_WHITESPACE) {
                    continue;
                }

                // We found the first bit of a code, or a comment on the
                // following line.
                break;
            }

            $found = $tokens[$closer]['line'] - $tokens[$prev]['line'];

            if (($tokens[$prev]['code'] !== T_OPEN_TAG && $found !== 1)
                || ($tokens[$prev]['code'] === T_OPEN_TAG && $found !== 0 && $found !== 1)
            ) {
                $error = 'Expected 1 newline before closing brace; %s found';

                $data = [$found];
                $fix = $phpcsFile->addFixableError($error, $closer, 'NewlineBeforeCloseBrace', $data);

                if ($fix === true) {
                    $phpcsFile->fixer->beginChangeset();

                    for ($i = $closer - 1; $i > $prev; $i--) {
                        $phpcsFile->fixer->replaceToken($i, '');
                    }

                    $phpcsFile->fixer->addContent($prev, $phpcsFile->eolChar);
                    $phpcsFile->fixer->endChangeset();
                }
            }

            $nextContent = $phpcsFile->findNext(
                T_WHITESPACE,
                $closer + 1,
                null,
                true
            );

            if ($tokens[$nextContent]['code'] !== T_CLOSE_TAG
                && $tokens[$nextContent]['code'] !== T_CLOSE_CURLY_BRACKET
                && $tokens[$nextContent]['code'] !== T_ELSE
                && $tokens[$nextContent]['code'] !== T_ELSEIF
                && $tokens[$nextContent]['code'] !== T_CATCH
                && ($tokens[$nextContent]['code'] !== T_WHILE
                    && $tokens[$stackPtr]['code'] !== T_DO)
                && $tokens[$nextContent]['code'] !== T_BREAK
                && ($tokens[$nextContent]['line'] === ($tokens[$closer]['line'] + 1))
            ) {
                $foundError = false;
                $errorPtr = null;

                if (in_array($tokens[$nextContent]['code'], Tokens::$commentTokens)) {
                    $lastContent = $this->getLastCommentOrSelf($phpcsFile, $nextContent);
                    $nextLastContent = $phpcsFile->findNext(
                        [T_WHITESPACE],
                        $lastContent + 1,
                        null,
                        true
                    );

                    if ($tokens[$nextLastContent]['code'] !== T_CLOSE_TAG
                        && $tokens[$nextLastContent]['code'] !== T_CLOSE_CURLY_BRACKET
                        && ($tokens[$lastContent]['line'] + 1) === $tokens[$nextLastContent]['line']
                    ) {
                        $foundError = true;
                        $errorPtr = $closer;
                    }
                } else {
                    $foundError = true;
                    $errorPtr = $closer;
                }

                if ($foundError) {
                    $data = [$tokens[$stackPtr]['content']];
                    $error = 'No blank line found after "%s" control structure or after comment control structure';
                    $fix = $phpcsFile->addFixableError(
                        $error,
                        $errorPtr,
                        'NoBlankLineAfterControlStructure',
                        $data
                    );

                    if ($fix === true) {
                        $phpcsFile->fixer->addNewline($closer);
                    }
                }
            }
        }

        // Single newline after opening brace.
        if (isset($tokens[$stackPtr]['scope_opener']) === true) {
            $opener = $tokens[$stackPtr]['scope_opener'];

            for ($next = $opener + 1; $next < $phpcsFile->numTokens; $next++) {
                $code = $tokens[$next]['code'];

                if ($code === T_WHITESPACE) {
                    continue;
                }

                // We found the first bit of a code, or a comment on the
                // following line.
                break;
            }

            $found = ($tokens[$next]['line'] - $tokens[$opener]['line']);

            if (($tokens[$next]['code'] !== T_CLOSE_TAG && $found !== 1)
                || ($tokens[$next]['code'] === T_CLOSE_TAG && $found !== 0 && $found !== 1)
            ) {
                $error = 'Expected 1 newline after opening brace; %s found';

                $data = [$found];
                $fix = $phpcsFile->addFixableError($error, $opener, 'NewlineAfterOpenBrace', $data);

                if ($fix === true) {
                    $phpcsFile->fixer->beginChangeset();

                    for ($i = ($opener + 1); $i < $next; $i++) {
                        if ($found > 0 && $tokens[$i]['line'] === $tokens[$next]['line']) {
                            break;
                        }

                        $phpcsFile->fixer->replaceToken($i, '');
                    }

                    $phpcsFile->fixer->addContent($opener, $phpcsFile->eolChar);
                    $phpcsFile->fixer->endChangeset();
                }
            }

            $prevContent = $phpcsFile->findPrevious(T_WHITESPACE, $stackPtr - 1, null, true);

            if ($tokens[$tokens[$stackPtr]['scope_opener']]['content'] !== ':'
                && $tokens[$prevContent]['code'] !== T_OPEN_TAG
                && $tokens[$prevContent]['code'] !== T_OPEN_CURLY_BRACKET
                && $tokens[$prevContent]['code'] !== T_COLON
                && $tokens[$stackPtr]['line'] === ($tokens[$prevContent]['line'] + 1)
            ) {
                $foundError = false;
                $errorPtr = null;

                if (in_array($tokens[$prevContent]['code'], Tokens::$commentTokens)) {
                    $leadingContent = $this->getLeadingCommentOrSelf($phpcsFile, $prevContent);
                    $prevLastContent = $phpcsFile->findPrevious(
                        [T_WHITESPACE],
                        ($leadingContent - 1),
                        null,
                        true
                    );

                    if ($tokens[$prevLastContent]['code'] !== T_OPEN_TAG
                        && $tokens[$prevLastContent]['code'] !== T_OPEN_CURLY_BRACKET
                        && ($tokens[$prevLastContent]['line'] + 1) === $tokens[$leadingContent]['line']
                    ) {
                        $foundError = true;
                        $errorPtr = $stackPtr;
                    }
                } else {
                    $foundError = true;
                    $errorPtr = $stackPtr;
                }

                if ($foundError) {
                    $data = [$tokens[$stackPtr]['content']];
                    $error = 'No blank line found before "%s" control structure or before comment control structure';
                    $fix = $phpcsFile->addFixableError(
                        $error,
                        $errorPtr,
                        'NoBlankLineBeforeControlStructure',
                        $data
                    );

                    if ($fix === true) {
                        $phpcsFile->fixer->beginChangeset();
                        $phpcsFile->fixer->addNewline($prevContent);
                        $phpcsFile->fixer->endChangeset();
                    }
                }
            }
        } elseif ($tokens[$stackPtr]['code'] === T_WHILE) {
            // Zero spaces after parenthesis closer.
            $closer = $tokens[$stackPtr]['parenthesis_closer'];
            $found = 0;

            if (isset($tokens[$closer + 1]) && $tokens[$closer + 1]['code'] === T_WHITESPACE) {
                if (strpos($tokens[$closer + 1]['content'], $phpcsFile->eolChar) !== false) {
                    $found = 'newline';
                } else {
                    $found = strlen($tokens[$closer + 1]['content']);
                }
            }

            if ($found !== 0) {
                $error = 'Expected 0 spaces before semicolon; %s found';
                $data = [$found];
                $fix = $phpcsFile->addFixableError($error, $closer, 'SpaceBeforeSemicolon', $data);

                if ($fix === true) {
                    $phpcsFile->fixer->replaceToken($closer + 1, '');
                }
            }
        }

        if ($tokens[$stackPtr]['code'] === T_ELSE
            || $tokens[$stackPtr]['code'] === T_ELSEIF
            || $tokens[$stackPtr]['code'] === T_CATCH
            || $tokens[$stackPtr]['code'] === T_FINALLY
        ) {
            $prev = $phpcsFile->findPrevious([T_WHITESPACE], $stackPtr - 1, null, true);
            $next = $phpcsFile->findNext([T_WHITESPACE], $stackPtr + 1, null, true);

            if (($prev !== false
                    && in_array($tokens[$prev]['code'], Tokens::$commentTokens))
                || ($next !== false
                    && in_array($tokens[$prev]['code'], Tokens::$commentTokens))
            ) {
                $errorPtr = $prev ? $prev : $next;
                $error = 'No comment between control structure braces';
                $data = [$found];
                $phpcsFile->addError($error, $errorPtr, 'NoCommentBetweenControlStructureBraces', $data);
            }
        }

        if ($tokens[$stackPtr]['code'] === T_DO
            || $tokens[$stackPtr]['code'] === T_ELSE
            || $tokens[$stackPtr]['code'] === T_ELSEIF
            || $tokens[$stackPtr]['code'] === T_CATCH
            || $tokens[$stackPtr]['code'] === T_FINALLY
        ) {
            if ($tokens[$stackPtr]['code'] === T_DO) {
                if (isset($tokens[$stackPtr]['scope_closer']) === false) {
                    return;
                }

                $closer = $tokens[$stackPtr]['scope_closer'];
            } else {
                $closer = $phpcsFile->findPrevious(Tokens::$emptyTokens, $stackPtr - 1, null, true);
            }

            if ($closer === false || $tokens[$closer]['code'] !== T_CLOSE_CURLY_BRACKET) {
                return;
            }

            // Single space after closing brace.
            $found = 1;

            if ($tokens[($closer + 1)]['code'] !== T_WHITESPACE) {
                $found = 0;
            } elseif ($tokens[($closer + 1)]['content'] !== ' ') {
                if (strpos($tokens[($closer + 1)]['content'], $phpcsFile->eolChar) !== false) {
                    $found = 'newline';
                } else {
                    $found = strlen($tokens[$closer + 1]['content']);
                }
            }

            if ($found !== 1) {
                $error = 'Expected 1 space after closing brace; %s found';
                $data = [$found];
                $phpcsFile->addError($error, $closer, 'SpaceAfterCloseBrace', $data);
            }
        }
    }

    /**
     * Returns leading comment or self.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile All the tokens found in the document.
     * @param int                  $stackPtr  The position of the current token
     *                                        in the stack passed in $tokens.
     *
     * @return bool|int
     */
    protected function getLeadingCommentOrSelf(File $phpcsFile, $stackPtr)
    {
        $prevTokens = [$stackPtr];
        $tokens = $phpcsFile->getTokens();

        do {
            $prev = end($prevTokens);

            $newPrev = $phpcsFile->findPrevious(
                T_WHITESPACE,
                ($prev - 1),
                null,
                true
            );

            if ($tokens[$newPrev]['code'] === T_COMMENT
                && $tokens[$newPrev]['line'] === ($tokens[$prev]['line'] - 1)
            ) {
                $prevTokens[] = $newPrev;
            } else {
                break;
            }
        } while (true);

        return end($prevTokens);
    }

    /**
     * Returns last comment or self.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile All the tokens found in the document.
     * @param int                  $stackPtr  The position of the current token
     *                                        in the stack passed in $tokens.
     *
     * @return bool|int
     */
    protected function getLastCommentOrSelf(File $phpcsFile, $stackPtr)
    {
        $nextTokens = [$stackPtr];
        $tokens = $phpcsFile->getTokens();

        do {
            $next = end($nextTokens);

            // $next may contain a non-existent position in file
            if (!isset($tokens[$next + 1])) {
                break;
            }

            $newPrev = $phpcsFile->findPrevious(
                T_WHITESPACE,
                ($next + 1),
                null,
                true
            );

            if ($tokens[$newPrev]['code'] === T_COMMENT
                && $tokens[$newPrev]['line'] === ($tokens[$next]['line'] + 1)
            ) {
                $nextTokens[] = $newPrev;
            } else {
                break;
            }
        } while (true);

        return end($nextTokens);
    }
}
