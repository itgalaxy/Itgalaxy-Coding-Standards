<?php
namespace ItgalaxyCodingStandards\Sniffs\WhiteSpace;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class PrecisionAlignmentSniff implements Sniff
{
    /**
     * Allow for providing a list of tokens for which (preceding) precision alignment should be ignored.
     *
     * <rule ref="WordPress.WhiteSpace.PrecisionAlignment">
     *    <properties>
     *        <property name="ignoreAlignmentTokens" type="array"
     *             value="T_COMMENT,T_INLINE_HTML"/>
     *    </properties>
     * </rule>
     *
     * @var array
     */
    public $ignoreAlignmentTokens = [];

    /**
     * The --tab-width CLI value that is being used.
     *
     * @var int
     */
    private $tab_width = 4;

    public function register()
    {
        return [T_OPEN_TAG];
    }

    public function process(File $phpcsFile, $stackPtr)
    {
        if (isset( $phpcsFile->config->tabWidth ) && $phpcsFile->config->tabWidth > 0) {
            $this->tab_width = $phpcsFile->config->tabWidth;
        }

        $tokens = $phpcsFile->getTokens();

        // Handle any custom ignore tokens received from a ruleset.
        $this->ignoreAlignmentTokens = $this->merge_custom_array($this->ignoreAlignmentTokens);
        $check_tokens = [
            T_WHITESPACE => true,
            T_INLINE_HTML => true,
            T_DOC_COMMENT_WHITESPACE => true,
            T_COMMENT => true
        ];

        for ($i = $stackPtr + 1; $i < $phpcsFile->numTokens; $i++) {
            if (!isset( $this->tokens[$i + 1])) {
                break;
            }

            if ($tokens[$i]['column'] !== 1) {
                continue;
            } elseif (isset($check_tokens[$this->tokens[$i]['code']]) === false
                || $tokens[$i + 1]['code'] === T_WHITESPACE
                || $tokens[$i]['content'] === $phpcsFile->eolChar
                || isset($this->ignoreAlignmentTokens[$this->tokens[$i]['type']])
                || isset($this->ignoreAlignmentTokens[$this->tokens[$i + 1]['type']])
            ) {
                continue;
            }

            $spaces = 0;

            switch ($tokens[$i]['type']) {
                case 'T_WHITESPACE':
                    $spaces = $tokens[$i]['length'] % $this->tab_width;
                    break;
                case 'T_DOC_COMMENT_WHITESPACE':
                    $length = $tokens[$i]['length'];
                    $spaces = $length % $this->tab_width;

                    if (($tokens[$i + 1]['code'] === T_DOC_COMMENT_STAR
                            || $tokens[$i + 1]['code'] === T_DOC_COMMENT_CLOSE_TAG)
                        && $spaces !== 0
                    ) {
                        // One alignment space expected before the *.
                        --$spaces;
                    }

                    break;
                case 'T_COMMENT':
                    /*
                     * Indentation whitespace for subsequent lines of multi-line comments
                     * are tokenized as part of the comment.
                     */
                    $comment = ltrim($tokens[$i]['content']);
                    $whitespace = str_replace($comment, '', $tokens[$i]['content']);
                    $length = strlen($whitespace);
                    $spaces = $length % $this->tab_width;

                    if (isset($comment[0]) && $comment[0] === '*' && $spaces !== 0) {
                        --$spaces;
                    }

                    break;
                case 'T_INLINE_HTML':
                    if ($tokens[$i]['content'] === $phpcsFile->eolChar) {
                        $spaces = 0;
                    } else {
                        /*
                         * Indentation whitespace for inline HTML is part of the T_INLINE_HTML token.
                         */
                        $content = ltrim($tokens[$i]['content']);
                        $whitespace = str_replace($content, '', $tokens[$i]['content']);
                        $spaces = strlen($whitespace) % $this->tab_width;
                    }

                    break;
            }

            if ($spaces > 0) {
                $phpcsFile->addWarning(
                    'Found precision alignment of %s spaces.',
                    $i,
                    'Found',
                    [$spaces]
                );
            }
        }
    }

    /**
     * Merge a pre-set array with a ruleset provided array or inline provided string.
     *
     * - Will correctly handle custom array properties which were set without
     *   the `type="array"` indicator.
     *   This also allows for making these custom array properties testable using
     *   a `@codingStandardsChangeSetting` comment in the unit tests.
     * - By default flips custom lists to allow for using `isset()` instead
     *   of `in_array()`.
     * - When `$flip` is true:
     *   * Presumes the base array is in a `'value' => true` format.
     *   * Any custom items will be given the value `false` to be able to
     *     distinguish them from pre-set (base array) values.
     *   * Will filter previously added custom items out from the base array
     *     before merging/returning to allow for resetting to the base array.
     *
     * {@internal Function is static as it doesn't use any of the properties or others
     * methods anyway and this way the `WordPress_Sniffs_NamingConventions_ValidVariableNameSniff`
     * which extends an upstream sniff can also use it.}}
     *
     * @since 0.11.0
     *
     * @param array|string $custom Custom list as provided via a ruleset.
     *                             Can be either a comma-delimited string or
     *                             an array of values.
     * @param array        $base   Optional. Base list. Defaults to an empty array.
     *                             Expects `value => true` format when `$flip` is true.
     * @param bool         $flip   Optional. Whether or not to flip the custom list.
     *                             Defaults to true.
     * @return array
     */
    public function merge_custom_array($custom, $base = [], $flip = true)
    {
        if ($flip === true) {
            $base = array_filter($base);
        }

        if (empty($custom) || (!is_array($custom) && !is_string($custom))) {
            return $base;
        }

        // Allow for a comma delimited list.
        if (is_string( $custom)) {
            $custom = explode(',', $custom);
        }

        // Always trim whitespace from the values.
        $custom = array_filter(array_map('trim', $custom));

        if ( true === $flip ) {
            $custom = array_fill_keys($custom, false);
        }

        if ( empty($base) ) {
            return $custom;
        }

        return array_merge($base, $custom);
    }
}
