<?php
namespace ItgalaxyCodingStandards\Sniffs\ControlStructures;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Util\Tokens;

class MultiLineConditionSniff implements Sniff
{
    /**
     * The number of spaces code should be indented.
     *
     * @var int
     */
    public $indent = 4;

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [
            T_IF,
            T_ELSEIF
        ];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                   $stackPtr  The position of the current token
     *                                         in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if (isset($tokens[$stackPtr]['parenthesis_opener']) === false) {
            return;
        }

        $emptyTokens = Tokens::$emptyTokens;
        $openBracket = $tokens[$stackPtr]['parenthesis_opener'];
        $closeBracket = $tokens[$stackPtr]['parenthesis_closer'];
        $spaceAfterOpen = 0;

        if ($tokens[$openBracket + 1]['code'] === T_WHITESPACE) {
            if (strpos($tokens[$openBracket + 1]['content'], $phpcsFile->eolChar) !== false) {
                $spaceAfterOpen = 'newline';
            } else {
                $spaceAfterOpen = strlen($tokens[$openBracket + 1]['content']);
            }
        }

        if ($spaceAfterOpen !== 0) {
            $error = 'First condition of a multi-line IF statement must directly follow the opening parenthesis';
            $fix = $phpcsFile->addFixableError($error, $openBracket + 1, 'SpacingAfterOpenBrace');

            if ($fix === true) {
                if ($spaceAfterOpen === 'newline') {
                    $phpcsFile->fixer->replaceToken($openBracket + 1, '');
                } else {
                    $phpcsFile->fixer->replaceToken($openBracket + 1, '');
                }
            }
        }

        // We need to work out how far indented the if statement
        // itself is, so we can work out how far to indent conditions.
        $statementIndent = 0;

        for ($i = ($stackPtr - 1); $i >= 0; $i--) {
            if ($tokens[$i]['line'] !== $tokens[$stackPtr]['line']) {
                $i++;
                break;
            }
        }

        if ($i >= 0 && $tokens[$i]['code'] === T_WHITESPACE) {
            $statementIndent = strlen($tokens[$i]['content']);
        }

        // Each line between the parenthesis should be indented 4 spaces
        // and start with an operator, unless the line is inside a
        // function call, in which case it is ignored.
        $lastLine = $tokens[$openBracket]['line'];

        for ($i = ($openBracket + 1); $i < $closeBracket; $i++) {
            if ($tokens[$i]['code'] === T_OPEN_PARENTHESIS) {
                $statementIndent += $this->indent;
            }

            if ($tokens[$i]['code'] === T_CLOSE_PARENTHESIS) {
                $statementIndent -= $this->indent;
            }

            if ($tokens[$i]['line'] !== $lastLine) {
                if ($tokens[$i]['line'] === $tokens[$closeBracket]['line']) {
                    $next = $phpcsFile->findNext(T_WHITESPACE, $i, null, true);

                    if ($next !== $closeBracket) {
                        // Closing bracket is on the same line as a condition.
                        $error = 'Closing parenthesis of a multi-line IF statement must be on a new line';
                        $fix = $phpcsFile->addFixableError($error, $closeBracket, 'CloseBracketNewLine');

                        if ($fix === true) {
                            // Account for a comment at the end of the line.
                            $next = $phpcsFile->findNext(T_WHITESPACE, $closeBracket + 1, null, true);

                            if ($tokens[$next]['code'] !== T_COMMENT) {
                                $phpcsFile->fixer->addNewlineBefore($closeBracket);
                            } else {
                                $next = $phpcsFile->findNext(
                                    $emptyTokens,
                                    $next + 1,
                                    null,
                                    true
                                );
                                $phpcsFile->fixer->beginChangeset();
                                $phpcsFile->fixer->replaceToken($closeBracket, '');
                                $phpcsFile->fixer->addContentBefore($next, ')');
                                $phpcsFile->fixer->endChangeset();
                            }
                        }

                        $expectedIndent = $statementIndent + $this->indent;
                    } else {
                        // Closing brace needs to be indented to the same level
                        // as the statement.
                        $expectedIndent = $statementIndent;
                    }//end if
                } else {
                    $expectedIndent = $statementIndent + $this->indent;
                }

                if ($tokens[$i]['code'] === T_COMMENT) {
                    $lastLine = $tokens[$i]['line'];
                    continue;
                }

                // We changed lines, so this should be a whitespace indent token.
                if ($tokens[$i]['code'] !== T_WHITESPACE) {
                    $foundIndent = 0;
                } else {
                    $foundIndent = strlen($tokens[$i]['content']);
                }

                if ($expectedIndent !== $foundIndent) {
                    $error = 'Multi-line IF statement not indented correctly; expected %s spaces but found %s';
                    $data = [
                        $expectedIndent,
                        $foundIndent
                    ];
                    $fix = $phpcsFile->addFixableError($error, $i, 'Alignment', $data);

                    if ($fix === true) {
                        $spaces = str_repeat(' ', $expectedIndent);

                        if ($foundIndent === 0) {
                            $phpcsFile->fixer->addContentBefore($i, $spaces);
                        } else {
                            $phpcsFile->fixer->replaceToken($i, $spaces);
                        }
                    }
                }

                if ($tokens[$i]['line'] !== $tokens[$closeBracket]['line']) {
                    $next = $phpcsFile->findNext($emptyTokens, $i, null, true);

                    if (isset(Tokens::$booleanOperators[$tokens[$next]['code']]) === false) {
                        $error = 'Each line in a multi-line IF statement must begin with a boolean operator';
                        $fix = $phpcsFile->addFixableError($error, $i, 'StartWithBoolean');

                        if ($fix === true) {
                            $prev = $phpcsFile->findPrevious(
                                $emptyTokens,
                                $i - 1,
                                $openBracket,
                                true
                            );

                            if (isset(Tokens::$booleanOperators[$tokens[$prev]['code']]) === true) {
                                $phpcsFile->fixer->beginChangeset();
                                $phpcsFile->fixer->replaceToken($prev, '');
                                $phpcsFile->fixer->addContentBefore($next, $tokens[$prev]['content'] . ' ');
                                $phpcsFile->fixer->endChangeset();
                            } else {
                                for ($x = $prev + 1; $x < $next; $x++) {
                                    $phpcsFile->fixer->replaceToken($x, '');
                                }
                            }
                        }
                    }
                }

                $lastLine = $tokens[$i]['line'];
            }

            if ($tokens[$i]['code'] === T_STRING) {
                $next = $phpcsFile->findNext(T_WHITESPACE, $i + 1, null, true);

                if ($tokens[$next]['code'] === T_OPEN_PARENTHESIS) {
                    // This is a function call, so skip to the end as they
                    // have their own indentation rules.
                    $i = $tokens[$next]['parenthesis_closer'];
                    $lastLine = $tokens[$i]['line'];
                    continue;
                }
            }
        }
    }
}
