<?php
/**
 * Squiz_Sniffs_XSS_EscapeOutputSniff.
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @author   Weston Ruter <weston@x-team.com>
 */
/**
 * Verifies that all outputted strings are escaped.
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @author   Weston Ruter <weston@x-team.com>
 * @link     http://codex.wordpress.org/Data_Validation Data Validation on WordPress Codex
 */

namespace ItgalaxyCodingStandards\Sniffs\Security;

class EscapeOutputSniff implements \PHP_CodeSniffer_Sniff
{
    /**
     * Functions which print output incorporating the values passed to them.
     *
     * @since 0.5.0
     *
     * @var array
     */
    public $printingFunctions = [
        'die',
        'echo',
        'exit',
        'print',
        'printf',
        'trigger_error',
        'user_error',
        'vprintf'
    ];

    /**
     * Printing functions that incorporate unsafe values.
     *
     * @since 0.4.0
     *
     * @var array
     */
    public $unsafePrintingFunctions = [];

    /**
     * Functions that format strings.
     *
     * These functions are often used for formatting values just before output, and
     * it is common practice to escape the individual parameters passed to them as
     * needed instead of escaping the entire result. This is especially true when the
     * string being formatted contains HTML, which makes escaping the full result
     * more difficult.
     *
     * @since 0.5.0
     *
     * @var array
     */
    public $formattingFunctions = [
        'array_fill' => 0,
        'implode' => 1,
        'join' => 2,
        'nl2br' => 3,
        'sprintf' => 4,
        'vsprintf' => 5
    ];

    /**
     * Custom list of functions which escape values for output.
     *
     * @since 0.5.0
     *
     * @var string[]
     */
    public $escapingFunctions = [
        'filter_input' => 0,
        'filter_var' => 1,
        'intval' => 2,
        'json_encode' => 3,
        'number_format' => 4,
        'htmlspecialchars' => 5,
        'htmlentities' => 6
    ];

    /**
     * Functions whose output is automatically escaped for display.
     *
     * @since 0.5.0
     *
     * @var array
     */
    public $autoEscapedFunctions = [];

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [
            T_ECHO,
            T_PRINT,
            T_EXIT,
            T_STRING
        ];
    }

    private static $normalize = false;

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token
     *                                        in the stack passed in $tokens.
     *
     * @return int|void
     */
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        if (self::$normalize === false) {
            if (is_string($this->printingFunctions)) {
                $this->printingFunctions = explode(',', $this->printingFunctions);
            }

            if (is_array($this->printingFunctions)
                && !empty($this->printingFunctions)
                && !in_array(null, $this->printingFunctions)
            ) {
                $this->printingFunctions = array_flip($this->printingFunctions);
            }

            if (is_string($this->unsafePrintingFunctions)) {
                $this->unsafePrintingFunctions = explode(',', $this->unsafePrintingFunctions);
            }

            if (is_array($this->unsafePrintingFunctions)
                && !empty($this->unsafePrintingFunctions)
                && !in_array(null, $this->unsafePrintingFunctions)
            ) {
                $this->unsafePrintingFunctions = array_flip($this->unsafePrintingFunctions);
            }

            if (is_string($this->unsafePrintingFunctions)) {
                $this->unsafePrintingFunctions = explode(',', $this->unsafePrintingFunctions);
            }

            if (is_array($this->formattingFunctions)
                && !empty($this->formattingFunctions)
                && !in_array(null, $this->formattingFunctions)
            ) {
                $this->formattingFunctions = array_flip($this->formattingFunctions);
            }

            if (is_string($this->escapingFunctions)) {
                $this->escapingFunctions = explode(',', $this->escapingFunctions);
            }

            if (is_array($this->escapingFunctions)
                && !empty($this->escapingFunctions)
                && !in_array(null, $this->escapingFunctions)
            ) {
                $this->escapingFunctions = array_flip($this->escapingFunctions);
            }

            if (is_string($this->autoEscapedFunctions)) {
                $this->autoEscapedFunctions = explode(',', $this->autoEscapedFunctions);
            }

            if (is_array($this->autoEscapedFunctions)
                && !empty($this->autoEscapedFunctions)
                && !in_array(null, $this->autoEscapedFunctions)
            ) {
                $this->autoEscapedFunctions = array_flip($this->autoEscapedFunctions);
            }

            self::$normalize = true;
        }

        $tokens = $phpcsFile->getTokens();

        $function = $tokens[$stackPtr]['content'];
        // Find the opening parenthesis (if present; T_ECHO might not have it).
        $openParenthesis = $phpcsFile->findNext(
            \PHP_CodeSniffer_Tokens::$emptyTokens,
            $stackPtr + 1,
            null,
            true
        );

        if ($tokens[$stackPtr]['code'] === T_STRING) {
            // Skip if it is a function but is not of the printing functions.
            if (!isset($this->printingFunctions[$tokens[$stackPtr]['content']])) {
                return false;
            }

            if (isset($tokens[$openParenthesis]['parenthesis_closer'])) {
                $endOfStatement = $tokens[$openParenthesis]['parenthesis_closer'];
            }

            // These functions only need to have the first argument escaped.
            if (in_array(
                $function,
                [
                    'trigger_error',
                    'user_error'
                ]
            )) {
                $endOfStatement = $phpcsFile->findEndOfStatement($openParenthesis + 1);
            }
        }

        // Checking for the ignore comment, ex: //escape ok
        if ($this->hasWhitelistComment($phpcsFile, 'escape ok', $stackPtr)) {
            return false;
        }

        if (isset($endOfStatement, $this->unsafePrintingFunctions[$function])) {
            $error = $phpcsFile->addError(
                'Expected next thing to be an escaping function (like %s), not "%s"',
                $stackPtr,
                'UnsafePrintingFunction',
                [
                    $this->unsafePrintingFunctions[$function],
                    $function
                ]
            );

            // If the error was reported, don't bother checking the function's arguments.
            if ($error) {
                return $endOfStatement;
            }
        }

        $ternary = false;

        // This is already determined if this is a function and not T_ECHO.
        if (!isset($endOfStatement)) {
            $endOfStatement = $phpcsFile->findNext(
                [
                    T_SEMICOLON,
                    T_CLOSE_TAG
                ],
                $stackPtr
            );

            $lastToken = $phpcsFile->findPrevious(
                \PHP_CodeSniffer_Tokens::$emptyTokens,
                $endOfStatement - 1,
                null,
                true
            );

            // Check for the ternary operator. We only need to do this here if this
            // echo is lacking parenthesis. Otherwise it will be handled below.
            if ($tokens[$openParenthesis]['code'] !== T_OPEN_PARENTHESIS
                || $tokens[$lastToken]['code'] !== T_CLOSE_PARENTHESIS
            ) {
                $ternary = $phpcsFile->findNext(T_INLINE_THEN, $stackPtr, $endOfStatement);

                // If there is a ternary skip over the part before the ?. However, if
                // the ternary is within parentheses, it will be handled in the loop.
                if ($ternary && empty($tokens[$ternary]['nested_parenthesis'])) {
                    $stackPtr = $ternary;
                }
            }
        }

        // Ignore the function itself.
        $stackPtr++;
        $inCast = false;
        // looping through echo'd components
        $watch = true;

        for ($i = $stackPtr; $i < $endOfStatement; $i++) {
            // Ignore whitespaces and comments.
            if (in_array(
                $tokens[$i]['code'],
                array_merge(
                    [T_WHITESPACE],
                    \PHP_CodeSniffer_Tokens::$commentTokens
                )
            )) {
                continue;
            }

            if ($tokens[$i]['code'] === T_OPEN_PARENTHESIS) {
                if ($inCast) {
                    // Skip to the end of a function call if it has been casted to a safe value.
                    $i = $tokens[$i]['parenthesis_closer'];
                    $inCast = false;
                } else {
                    // Skip over the condition part of a ternary (i.e., to after the ?).
                    $ternary = $phpcsFile->findNext(
                        T_INLINE_THEN,
                        $i,
                        $tokens[$i]['parenthesis_closer']
                    );

                    if ($ternary) {
                        $nextParen = $phpcsFile->findNext(
                            T_OPEN_PARENTHESIS,
                            $i + 1,
                            $tokens[$i]['parenthesis_closer']
                        );

                        // We only do it if the ternary isn't within a subset of parentheses.
                        if (!$nextParen || $ternary > $tokens[$nextParen]['parenthesis_closer']) {
                            $i = $ternary;
                        }
                    }
                }

                continue;
            }

            if ($tokens[$i]['code'] === T_NS_SEPARATOR) {
                continue;
            }

            // Handle arrays for those functions that accept them.
            if ($tokens[$i]['code'] === T_ARRAY) {
                $i++;
                continue;
            }

            if (in_array(
                $tokens[$i]['code'],
                [
                    T_DOUBLE_ARROW,
                    T_CLOSE_PARENTHESIS
                ]
            )) {
                continue;
            }

            // Handle magic constants for debug functions.
            if (in_array(
                $tokens[$i]['code'],
                [
                    T_METHOD_C,
                    T_FUNC_C,
                    T_FILE,
                    T_CLASS_C
                ]
            )) {
                continue;
            }

            // Wake up on concatenation characters, another part to check
            if (in_array($tokens[$i]['code'], [T_STRING_CONCAT])) {
                $watch = true;
                continue;
            }

            // Wake up after a ternary else (:).
            if ($ternary && in_array($tokens[$i]['code'], [T_INLINE_ELSE])) {
                $watch = true;
                continue;
            }

            // Wake up for commas.
            if ($tokens[$i]['code'] === T_COMMA) {
                $inCast = false;
                $watch = true;
                continue;
            }

            if ($watch === false) {
                continue;
            }

            // Allow T_CONSTANT_ENCAPSED_STRING eg: echo 'Some String';
            // Also T_LNUMBER, e.g.: echo 45; exit -1; and booleans.
            if (in_array(
                $tokens[$i]['code'],
                [
                    T_CONSTANT_ENCAPSED_STRING,
                    T_LNUMBER,
                    T_MINUS,
                    T_TRUE,
                    T_FALSE,
                    T_NULL
                ]
            )) {
                continue;
            }

            $watch = false;

            // Allow int/double/bool casted variables
            if (in_array(
                $tokens[$i]['code'],
                [
                    T_INT_CAST,
                    T_DOUBLE_CAST,
                    T_BOOL_CAST
                ]
            )) {
                $inCast = true;
                continue;
            }

            // Allow boolean
            if (in_array(
                $tokens[$i]['code'],
                [
                    T_TRUE,
                    T_FALSE
                ]
            )) {
                continue;
            }

            if ($tokens[$i]['code'] === T_BOOLEAN_NOT) {
                continue;
            }

            // Now check that next token is a function call.
            if ($tokens[$i]['code'] === T_STRING) {
                $ptr = $i;
                $functionName = $tokens[$i]['content'];
                $functionOpener = $phpcsFile->findNext(
                    [T_OPEN_PARENTHESIS],
                    $i + 1,
                    null,
                    null,
                    null,
                    true
                );

                $isFormattingFunction = isset($this->formattingFunctions[$functionName]);

                if ($functionOpener) {
                    if ('array_map' === $functionName) {
                        // Get the first parameter (name of function being used on the array).
                        $mappedFunction = $phpcsFile->findNext(
                            \PHP_CodeSniffer_Tokens::$emptyTokens,
                            $functionOpener + 1,
                            $tokens[$functionOpener]['parenthesis_closer'],
                            true
                        );

                        // If we're able to resolve the function name, do so.
                        if ($mappedFunction
                            && T_CONSTANT_ENCAPSED_STRING === $tokens[$mappedFunction]['code']
                        ) {
                            $functionName = trim($tokens[$mappedFunction]['content'], '\'');
                            $ptr = $mappedFunction;
                        }
                    }

                    // Skip pointer to after the function.
                    // If this is a formatting function we just skip over the opening
                    // parenthesis. Otherwise we skip all the way to the closing.
                    if ($isFormattingFunction) {
                        $i = $functionOpener + 1;
                        $watch = true;
                    } else {
                        $i = $tokens[$functionOpener]['parenthesis_closer'];
                    }
                }

                if ($isFormattingFunction
                    || isset($this->autoEscapedFunctions[$functionName])
                    || isset($this->escapingFunctions[$functionName])
                ) {
                    continue;
                }

                $content = $functionName;
            } else {
                $content = $tokens[$i]['content'];
                $ptr = $i;
            }

            $phpcsFile->addError(
                "Security problem. Expected next thing to be an escaping function, not '%s'",
                $ptr,
                'OutputNotEscaped',
                $content
            );
        }

        return $endOfStatement;
    }

    /**
     * Find whitelisting comment.
     *
     * Comment must be at the end of the line, and use // format.
     * It can be prefixed or suffixed with anything e.g. "foobar" will match:
     * ... // foobar okay
     * ... // WPCS: foobar whitelist.
     *
     * There is an exception, and that is when PHP is being interspersed with HTML.
     * In that case, the comment should come at the end of the statement (right
     * before the closing tag, ?>). For example:
     *
     * <input type="text" id="<?php echo $id; // XSS OK ?>" />
     *
     * @since 0.4.0
     *
     * @return boolean True if whitelisting comment was found, false otherwise.
     */
    protected function hasWhitelistComment(\PHP_CodeSniffer_File $phpcsFile, $comment, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        // There is a findEndOfStatement() method, but it considers more tokens than
        // we need to here.
        $endOfStatement = $phpcsFile->findEndOfStatement($stackPtr);
        $lastPtr = $phpcsFile->findNext(T_WHITESPACE, $endOfStatement + 1, null, true);
        $last = $tokens[$lastPtr];

        if ($last['code'] === T_COMMENT) {
            return preg_match('#' . preg_quote($comment) . '#i', $last['content']);
        } else {
            return false;
        }
    }
}
