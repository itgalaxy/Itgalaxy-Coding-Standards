<?php
/**
 * Sniffs_Squiz_WhiteSpace_OperatorSpacingSniff.
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @author    Marc McIntyre <mmcintyre@squiz.net>
 * @copyright 2006-2014 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */

/**
 * Sniffs_Squiz_WhiteSpace_OperatorSpacingSniff.
 *
 * Verifies that operators have valid spacing surrounding them.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @author    Marc McIntyre <mmcintyre@squiz.net>
 * @copyright 2006-2014 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */

namespace ItgalaxyCodingStandards\Sniffs\WhiteSpace;

class OperatorSpacingSniff implements \PHP_CodeSniffer_Sniff
{
    /**
     * Allow newlines instead of spaces.
     *
     * @var boolean
     */
    public $ignoreNewlines = true;

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        $comparison = \PHP_CodeSniffer_Tokens::$comparisonTokens;
        $operators = \PHP_CodeSniffer_Tokens::$operators;
        $assignment = \PHP_CodeSniffer_Tokens::$assignmentTokens;
        $inlineIf = [
            T_INLINE_THEN,
            T_INLINE_ELSE
        ];

        return array_unique(
            array_merge($comparison, $operators, $assignment, $inlineIf)
        );
    }

    /**
     * Processes this sniff, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The current file being checked.
     * @param int                  $stackPtr  The position of the current token in
     *                                        the stack passed in $tokens.
     *
     * @return void
     */
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        // Skip default values in function declarations.
        if ($tokens[$stackPtr]['code'] === T_EQUAL
            || $tokens[$stackPtr]['code'] === T_MINUS
        ) {
            if (isset($tokens[$stackPtr]['nested_parenthesis']) === true) {
                $parenthesis = array_keys($tokens[$stackPtr]['nested_parenthesis']);
                $bracket = array_pop($parenthesis);

                if (isset($tokens[$bracket]['parenthesis_owner']) === true) {
                    $function = $tokens[$bracket]['parenthesis_owner'];

                    if ($tokens[$function]['code'] === T_FUNCTION
                        || $tokens[$function]['code'] === T_CLOSURE
                    ) {
                        return;
                    }
                }
            }
        }

        if ($tokens[$stackPtr]['code'] === T_EQUAL) {
            // Skip for '=&' case.
            if (isset($tokens[($stackPtr + 1)]) === true
                && $tokens[($stackPtr + 1)]['code'] === T_BITWISE_AND
            ) {
                return;
            }
        }

        // Skip short ternary such as: "$foo = $bar ?: true;".
        if (($tokens[$stackPtr]['code'] === T_INLINE_THEN
                && $tokens[($stackPtr + 1)]['code'] === T_INLINE_ELSE)
            || ($tokens[($stackPtr - 1)]['code'] === T_INLINE_THEN
                && $tokens[$stackPtr]['code'] === T_INLINE_ELSE)
        ) {
            return;
        }

        if ($tokens[$stackPtr]['code'] === T_BITWISE_AND) {
            // If it's not a reference, then we expect one space either side of the
            // bitwise operator.
            if ($phpcsFile->isReference($stackPtr) === true) {
                return;
            }

            // Check there is one space before the & operator.
            if ($tokens[($stackPtr - 1)]['code'] !== T_WHITESPACE) {
                $error = 'Expected 1 space before "&" operator; 0 found';
                $fix = $phpcsFile->addFixableError($error, $stackPtr, 'NoSpaceBeforeAmp');

                if ($fix === true) {
                    $phpcsFile
                        ->fixer
                        ->addContentBefore($stackPtr, ' ');
                }

                $phpcsFile->recordMetric($stackPtr, 'Space before operator', 0);
            } else {
                if ($tokens[($stackPtr - 2)]['line'] !== $tokens[$stackPtr]['line']) {
                    $found = 'newline';
                } else {
                    $found = $tokens[($stackPtr - 1)]['length'];
                }

                $phpcsFile->recordMetric($stackPtr, 'Space before operator', $found);

                if ($found !== 1
                    && ($found !== 'newline' || $this->ignoreNewlines === false)
                ) {
                    $error = 'Expected 1 space before "&" operator; %s found';
                    $data = [$found];
                    $fix = $phpcsFile->addFixableError($error, $stackPtr, 'SpacingBeforeAmp', $data);

                    if ($fix === true) {
                        $phpcsFile
                            ->fixer
                            ->replaceToken(($stackPtr - 1), ' ');
                    }
                }
            }

            // Check there is one space after the & operator.
            if ($tokens[($stackPtr + 1)]['code'] !== T_WHITESPACE) {
                $error = 'Expected 1 space after "&" operator; 0 found';
                $fix = $phpcsFile->addFixableError($error, $stackPtr, 'NoSpaceAfterAmp');

                if ($fix === true) {
                    $phpcsFile
                        ->fixer
                        ->addContent($stackPtr, ' ');
                }

                $phpcsFile->recordMetric($stackPtr, 'Space after operator', 0);
            } else {
                if (isset($tokens[($stackPtr + 2)]) === true
                    && $tokens[($stackPtr + 2)]['line'] !== $tokens[$stackPtr]['line']
                ) {
                    $found = 'newline';
                } else {
                    $found = $tokens[($stackPtr + 1)]['length'];
                }

                $phpcsFile->recordMetric($stackPtr, 'Space after operator', $found);

                if ($found !== 1
                    && ($found !== 'newline' || $this->ignoreNewlines === false)
                ) {
                    $error = 'Expected 1 space after "&" operator; %s found';
                    $data = [$found];
                    $fix = $phpcsFile->addFixableError($error, $stackPtr, 'SpacingAfterAmp', $data);

                    if ($fix === true) {
                        $phpcsFile
                            ->fixer
                            ->replaceToken(($stackPtr + 1), ' ');
                    }
                }
            }

            return;
        }

        if ($tokens[$stackPtr]['code'] === T_PLUS) {
            $prev = $phpcsFile->findPrevious(T_WHITESPACE, ($stackPtr - 1), null, true);

            if (isset(\PHP_CodeSniffer_Tokens::$assignmentTokens[$tokens[$prev]['code']]) === true) {
                // Just trying to assign a negative value; eg. ($var = -1).
                return;
            }
        }

        if ($tokens[$stackPtr]['code'] === T_MINUS) {
            // Check minus spacing, but make sure we aren't just assigning
            // a minus value or returning one.
            $prev = $phpcsFile->findPrevious(T_WHITESPACE, ($stackPtr - 1), null, true);

            if ($tokens[$prev]['code'] === T_RETURN) {
                // Just returning a negative value; eg. (return -1).
                return;
            }

            if (isset(\PHP_CodeSniffer_Tokens::$operators[$tokens[$prev]['code']]) === true) {
                // Just trying to operate on a negative value; eg. ($var * -1).
                return;
            }

            if (isset(\PHP_CodeSniffer_Tokens::$comparisonTokens[$tokens[$prev]['code']]) === true) {
                // Just trying to compare a negative value; eg. ($var === -1).
                return;
            }

            if (isset(\PHP_CodeSniffer_Tokens::$booleanOperators[$tokens[$prev]['code']]) === true) {
                // Just trying to compare a negative value; eg. ($var || -1 === $b).
                return;
            }

            if (isset(\PHP_CodeSniffer_Tokens::$assignmentTokens[$tokens[$prev]['code']]) === true) {
                // Just trying to assign a negative value; eg. ($var = -1).
                return;
            }

            // A list of tokens that indicate that the token is not
            // part of an arithmetic operation.
            $invalidTokens = [
                T_COMMA => true,
                T_OPEN_PARENTHESIS => true,
                T_OPEN_SQUARE_BRACKET => true,
                T_OPEN_SHORT_ARRAY => true,
                T_DOUBLE_ARROW => true,
                T_COLON => true,
                T_INLINE_THEN => true,
                T_INLINE_ELSE => true,
                T_CASE => true
            ];

            if (isset($invalidTokens[$tokens[$prev]['code']]) === true) {
                // Just trying to use a negative value; eg. myFunction($var, -2).
                return;
            }
        }

        $operator = $tokens[$stackPtr]['content'];

        if ($tokens[($stackPtr - 1)]['code'] !== T_WHITESPACE) {
            $error = 'Expected 1 space before "' . $operator . '"; 0 found';
            $fix = $phpcsFile->addFixableError($error, $stackPtr, 'NoSpaceBefore');

            if ($fix === true) {
                $phpcsFile
                    ->fixer
                    ->addContentBefore($stackPtr, ' ');
            }

            $phpcsFile->recordMetric($stackPtr, 'Space before operator', 0);
        } else {
            if ($tokens[($stackPtr - 2)]['line'] !== $tokens[$stackPtr]['line']) {
                $found = 'newline';
            } else {
                $found = $tokens[($stackPtr - 1)]['length'];
            }

            if ($tokens[$stackPtr]['type'] === 'T_INLINE_THEN') {
                $next = $stackPtr + 1;

                while ($next !== false) {
                    if ($tokens[$next]['type'] === 'T_INLINE_ELSE') {
                        break;
                    }

                    $next = $phpcsFile->findNext(
                        T_INLINE_ELSE,
                        ($next + 1),
                        null,
                        false,
                        null,
                        true
                    );
                }

                if ($next) {
                    if ($tokens[$stackPtr]['line'] !== $tokens[$next]['line'] && $found !== 'newline') {
                        $data = [
                            $operator,
                            $found
                        ];
                        $error = 'Expected newline before "%s"; %s found spaces';
                        $phpcsFile->addError($error, $stackPtr, 'NoNewlineBeforeMultilineTernaryThen', $data);
                    }

                    if ($tokens[$stackPtr]['line'] === $tokens[$next]['line'] && $found === 'newline') {
                        $data = [$tokens[$next]['content']];
                        $error = 'Expected newline before "%s"';
                        $phpcsFile->addError($error, $stackPtr, 'NoNewlineBeforeMultilineTernaryElse', $data);
                    }
                }
            }

            if ($tokens[$stackPtr]['type'] === 'T_INLINE_ELSE') {
                $prev = $stackPtr - 1;

                while ($prev !== false) {
                    if ($tokens[$prev]['type'] === 'T_INLINE_THEN') {
                        break;
                    }

                    $prev = $phpcsFile->findPrevious(
                        T_INLINE_THEN,
                        ($prev - 1),
                        null,
                        false,
                        null,
                        true
                    );
                }

                if ($prev) {
                    if ($tokens[($stackPtr + 2)]['line'] !== $tokens[$stackPtr]['line']) {
                        $afterFound = 'newline';
                    } else {
                        $afterFound = $tokens[($stackPtr + 1)]['length'];
                    }

                    if ($tokens[$stackPtr]['line'] === $tokens[$prev]['line'] && $afterFound === 'newline') {
                        $data = [$tokens[$stackPtr]['content']];
                        $error = 'Expected newline before "%s"';
                        $phpcsFile->addError($error, $stackPtr, 'NoNewlineBeforeMultilineTernaryElse', $data);
                    }
                }
            }

            $phpcsFile->recordMetric($stackPtr, 'Space before operator', $found);

            if ($found !== 1
                && ($found !== 'newline' || $this->ignoreNewlines === false)
            ) {
                $error = 'Expected 1 space before "%s"; %s found';
                $data = [
                    $operator,
                    $found
                ];
                $fix = $phpcsFile->addFixableError($error, $stackPtr, 'SpacingBefore', $data);

                if ($fix === true) {
                    $phpcsFile
                        ->fixer
                        ->beginChangeset();

                    if ($found === 'newline') {
                        $i = ($stackPtr - 2);

                        while ($tokens[$i]['code'] === T_WHITESPACE) {
                            $phpcsFile
                                ->fixer
                                ->replaceToken($i, '');
                            $i--;
                        }
                    }

                    $phpcsFile
                        ->fixer
                        ->replaceToken(($stackPtr - 1), ' ');
                    $phpcsFile
                        ->fixer
                        ->endChangeset();
                }
            }
        }

        if (isset($tokens[($stackPtr + 1)]) === false) {
            return;
        }

        if ($tokens[($stackPtr + 1)]['code'] !== T_WHITESPACE) {
            $error = 'Expected 1 space after "' . $operator . '"; 0 found';
            $fix = $phpcsFile->addFixableError($error, $stackPtr, 'NoSpaceAfter');

            if ($fix === true) {
                $phpcsFile
                    ->fixer
                    ->addContent($stackPtr, ' ');
            }

            $phpcsFile->recordMetric($stackPtr, 'Space after operator', 0);
        } else {
            if ($tokens[($stackPtr + 2)]['line'] !== $tokens[$stackPtr]['line']) {
                $found = 'newline';
            } else {
                $found = $tokens[($stackPtr + 1)]['length'];
            }

            if ($tokens[$stackPtr]['type'] === 'T_INLINE_THEN' && $found === 'newline') {
                $error = 'Expected 1 space after "%s"; %s found';
                $data = [
                    $operator,
                    $found
                ];
                $phpcsFile->addError($error, $stackPtr, 'NewlineBeforeMultilineTernaryThen', $data);
            }

            if ($tokens[$stackPtr]['type'] === 'T_INLINE_ELSE' && $found === 'newline') {
                $error = 'Expected 1 space after "%s"; %s found';
                $data = [
                    $operator,
                    $found
                ];
                $phpcsFile->addError($error, $stackPtr, 'NewlineBeforeMultilineTernaryElse', $data);
            }

            $phpcsFile->recordMetric($stackPtr, 'Space after operator', $found);

            if ($found !== 1
                && ($found !== 'newline' || $this->ignoreNewlines === false)
            ) {
                $error = 'Expected 1 space after "%s"; %s found';
                $data = [
                    $operator,
                    $found
                ];
                $fix = $phpcsFile->addFixableError($error, $stackPtr, 'SpacingAfter', $data);

                if ($fix === true) {
                    $phpcsFile
                        ->fixer
                        ->replaceToken(($stackPtr + 1), ' ');
                }
            }
        }
    }
}
