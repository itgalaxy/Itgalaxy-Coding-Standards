<?php
/**
 * Drupal_Sniffs_Semantics_PregSecuritySniff.
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */

/**
 * Check the usage of the preg functions to ensure the insecure /e flag isn't
 * used: http://drupal.org/node/750148
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */

namespace ItgalaxyCodingStandards\Sniffs\Security;

class PregSecuritySniff extends FunctionCallSniffAbstract
{
    private $delimiters = [
        '/',
        '#',
        '+',
        '%',
        '(',
        '{',
        '[',
        '<'
    ];
    /**
     * Returns an array of function names this test wants to listen for.
     *
     * @return array
     */
    public function registerFunctionNames()
    {
        return [
            'preg_filter',
            'preg_grep',
            'preg_match',
            'preg_match_all',
            'preg_replace',
            'preg_replace_callback',
            'preg_split'
        ];
    }

    /**
     * Processes this function call.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int $stackPtr The position of the function call in the stack.
     * @param int $openBracket The position of the opening parenthesis in the stack.
     * @param int $closeBracket The position of the closing parenthesis in the stack.
     *
     * @return void
     */
    public function processFunctionCall(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $argument = $this->getArgument(1);

        if ($argument === false) {
            return;
        }

        $pattern = $tokens[$argument['start']]['content'];
        $quote = substr($pattern, 0, 1);

        // Check that the pattern is a string.
        if ($quote === '"' || $quote === "'") {
            // Get the delimiter - first char after the enclosing quotes.
            $delimiterStart = substr($pattern, 1, 1);
            $patternWithoutModifiers = rtrim(
                $pattern,
                'imsxeADSUXJu' . $quote
            );
            $delimiterEnd = substr($patternWithoutModifiers, strlen($patternWithoutModifiers) - 2, 1);

            if ($delimiterStart != $delimiterEnd
                && !in_array($delimiterStart, $this->delimiters)
                && !in_array($delimiterEnd, $this->delimiters)
            ) {
                return;
            }

            $delimiter = preg_quote($delimiterStart, '/');

            // Check if there is the evil e flag.
            if (preg_match('/' . $delimiter . '[\w]{0,}e[\w]{0,}$/', substr($pattern, 0, -1)) === 1) {
                $warn = 'Using the e flag in %s is a possible security risk. '
                    . 'For details see http://drupal.org/node/750148';
                $phpcsFile->addError(
                    $warn,
                    $argument['start'],
                    'PregEFlag',
                    [$tokens[$stackPtr]['content']]
                );

                return;
            }
        }
    }
}
