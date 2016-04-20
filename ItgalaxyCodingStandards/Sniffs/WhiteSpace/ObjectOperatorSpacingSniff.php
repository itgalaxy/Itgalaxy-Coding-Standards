<?php
/**
 * PEAR_Sniffs_WhiteSpace_ObjectOperatorIndentSniff.
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2014 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
/**
 * PEAR_Sniffs_WhiteSpace_ObjectOperatorIndentSniff.
 *
 * Checks that object operators are indented 4 spaces if they are the first
 * thing on a line.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2014 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */

namespace ItgalaxyCodingStandards\Sniffs\WhiteSpace;

class ObjectOperatorSpacingSniff implements \PHP_CodeSniffer_Sniff
{
    /**
     * Allow newlines instead of spaces.
     *
     * @var boolean
     */
    public $ignoreNewlinesBefore = true;

    /**
     * Allow newlines instead of spaces.
     *
     * @var boolean
     */
    public $ignoreNewlinesAfter = false;

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
        return [T_OBJECT_OPERATOR];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile All the tokens found in the document.
     * @param int                  $stackPtr  The position of the current token
     *                                        in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if ($tokens[($stackPtr - 1)]['code'] !== T_WHITESPACE) {
            $before = 0;
        } else {
            if ($tokens[($stackPtr - 2)]['line'] !== $tokens[$stackPtr]['line']) {
                $before = 'newline';
            } else {
                $before = $tokens[($stackPtr - 1)]['length'];
            }
        }

        if ($tokens[($stackPtr + 1)]['code'] !== T_WHITESPACE) {
            $after = 0;
        } else {
            if ($tokens[($stackPtr + 2)]['line'] !== $tokens[$stackPtr]['line']) {
                $after = 'newline';
            } else {
                $after = $tokens[($stackPtr + 1)]['length'];
            }
        }

        $phpcsFile->recordMetric($stackPtr, 'Spacing before object operator', $before);
        $phpcsFile->recordMetric($stackPtr, 'Spacing after object operator', $after);

        if ($before !== 0) {
            $errorBefore = true;

            if ($before === 'newline' && $this->ignoreNewlinesBefore) {
                $errorBefore = false;
            }

            if ($errorBefore) {
                $error = 'Space found before object operator';
                $fix = $phpcsFile->addFixableError($error, $stackPtr, 'Before');

                if ($fix === true) {
                    $phpcsFile
                        ->fixer
                        ->replaceToken(($stackPtr - 1), '');
                }
            }
        }

        if ($after !== 0) {
            $errorAfter = true;

            if ($after === 'newline' && $this->ignoreNewlinesAfter) {
                $errorAfter = false;
            }

            if ($errorAfter) {
                $error = 'Space found after object operator';
                $fix = $phpcsFile->addFixableError($error, $stackPtr, 'After');

                if ($fix === true) {
                    $phpcsFile
                        ->fixer
                        ->replaceToken(($stackPtr + 1), '');
                }
            }
        }

        return true;

        // Make sure this is the first object operator in a chain of them.
        $prevObjectOperator = $phpcsFile->findPrevious(
            T_OBJECT_OPERATOR,
            $stackPtr - 1,
            null,
            false,
            null,
            true
        );
        $nextObjectOperator = $phpcsFile->findNext(
            T_OBJECT_OPERATOR,
            $stackPtr + 1,
            null,
            false,
            null,
            true
        );


        $varToken = $phpcsFile->findPrevious(
            T_WHITESPACE,
            $stackPtr - 1,
            null,
            true
        );

        // Check it is first object operator in chain
        if ($tokens[$prevObjectOperator]['code'] !== T_OBJECT_OPERATOR
            && $tokens[$nextObjectOperator]['code'] === T_OBJECT_OPERATOR
            && $tokens[$stackPtr]['line'] == $tokens[$varToken]['line']
        ) {
            $error = 'First object operator in chain must be start new line';
            $phpcsFile->addFixableError($error, $stackPtr, 'FirstNoNewLineInChain');
        }

        return;



        // Make sure this is a chained call.
        $next = $phpcsFile->findNext(
            T_OBJECT_OPERATOR,
            ($stackPtr + 1),
            null,
            false,
            null,
            true
        );

        // Determine correct indent.
        for ($i = ($varToken - 1); $i >= 0; $i--) {
            if ($tokens[$i]['line'] !== $tokens[$varToken]['line']) {
                $i++;
                break;
            }
        }

        $requiredIndent = 0;

        if ($i >= 0 && $tokens[$i]['code'] === T_WHITESPACE) {
            $requiredIndent = strlen($tokens[$i]['content']);
        }

        $requiredIndent += $this->indent;
        // Determine the scope of the original object operator.
        $origBrackets = null;

        if (isset($tokens[$stackPtr]['nested_parenthesis']) === true) {
            $origBrackets = $tokens[$stackPtr]['nested_parenthesis'];
        }

        $origConditions = null;

        if (isset($tokens[$stackPtr]['conditions']) === true) {
            $origConditions = $tokens[$stackPtr]['conditions'];
        }

        /*
        $next = $stackPtr;

        while ($next !== false) {
            $nextVarToken = $phpcsFile->findNext(T_STRING, ($next + 1), null, false);
            $prev = $next;
            $next = $phpcsFile->findNext(
                T_OBJECT_OPERATOR,
                ($next + 1),
                null,
                false,
                null,
                true
            );
            $prevVarToken = $phpcsFile->findPrevious(T_STRING, ($next - 1), null, true);

            print_r($tokens[$prevVarToken]);
            // print_r($tokens[$nextVarToken]);
            // print_r($tokens[$prevVarToken]);

            if ($prevVarToken !== $nextVarToken) {
                break;
            }

            if ($prev !== $next) {
                if ($tokens[$varToken]['line'] === $tokens[$stackPtr]['line']) {
                    $error = 'First object operator in chain must be start new line';
                    $phpcsFile->addFixableError($error, $stackPtr, 'FirstNoNewLineInChain');
                }
            }

            if ($prev !== $next
                && $tokens[$prev]['line'] === $tokens[$next]['line']
            ) {
                $error = 'Each object operator in chain must be start new line';
                $phpcsFile->addError($error, $prev, 'EachNoNewLineInChain');
            }
        }

        exit();
        */

        // Check indentation of each object operator in the chain.
        // If the first object operator is on a different line than
        // the variable, make sure we check its indentation too.
        if ($tokens[$stackPtr]['line'] > $tokens[$varToken]['line']) {
            $next = $stackPtr;
        }

        while ($next !== false) {
            // Make sure it is in the same scope, otherwise don't check indent.
            $brackets = null;

            if (isset($tokens[$next]['nested_parenthesis']) === true) {
                $brackets = $tokens[$next]['nested_parenthesis'];
            }

            $conditions = null;

            if (isset($tokens[$next]['conditions']) === true) {
                $conditions = $tokens[$next]['conditions'];
            }

            if ($origBrackets === $brackets && $origConditions === $conditions) {
                // Make sure it starts a line, otherwise dont check indent.
                $prev = $phpcsFile->findPrevious(T_WHITESPACE, ($next - 1), $stackPtr, true);
                $indent = $tokens[($next - 1)];

                if ($tokens[$prev]['line'] !== $tokens[$next]['line']
                    && $indent['code'] === T_WHITESPACE
                ) {
                    if ($indent['line'] === $tokens[$next]['line']) {
                        $foundIndent = strlen($indent['content']);
                    } else {
                        $foundIndent = 0;
                    }

                    if ($foundIndent !== $requiredIndent) {
                        $error = 'Object operator not indented correctly; expected %s spaces but found %s';
                        $data = [
                            $requiredIndent,
                            $foundIndent
                        ];
                        $fix = $phpcsFile->addFixableError($error, $next, 'Incorrect', $data);

                        if ($fix === true) {
                            $spaces = str_repeat(' ', $requiredIndent);

                            if ($foundIndent === 0) {
                                $phpcsFile
                                    ->fixer
                                    ->addContentBefore($next, $spaces);
                            } else {
                                $phpcsFile
                                    ->fixer
                                    ->replaceToken(($next - 1), $spaces);
                            }
                        }
                    }
                }

                // It cant be the last thing on the line either.
                $content = $phpcsFile->findNext(T_WHITESPACE, ($next + 1), null, true);

                if ($tokens[$content]['line'] !== $tokens[$next]['line']) {
                    $error = 'Object operator must be at the start of the line, not the end';
                    $fix = $phpcsFile->addFixableError($error, $next, 'StartOfLine');

                    if ($fix === true) {
                        $phpcsFile
                            ->fixer
                            ->beginChangeset();

                        for ($x = ($next + 1); $x < $content; $x++) {
                            $phpcsFile
                                ->fixer
                                ->replaceToken($x, '');
                        }

                        $phpcsFile
                            ->fixer
                            ->addNewlineBefore($next);
                        $phpcsFile
                            ->fixer
                            ->endChangeset();
                    }
                }
            }

            $next = $phpcsFile->findNext(
                T_OBJECT_OPERATOR,
                ($next + 1),
                null,
                false,
                null,
                true
            );
        }
    }
}
