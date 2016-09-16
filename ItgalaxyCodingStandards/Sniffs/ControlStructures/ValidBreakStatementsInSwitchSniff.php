<?php
/**
 * BetterCollectiveCodeStandard_Sniffs_ControlStructures_ValidBreakStatementsInSwitchesSniff.
 *
 * PHP version 5
 *
 * @category  ControlStructures
 * @author    Laura Thewalt <laura.thewalt@wmdb.de>
 * @author    Stefano Kowalke <blueduck@gmx.net>
 * @copyright 2010 Stefano Kowalke
 * @license   http://www.gnu.org/copyleft/gpl.html GNU Public License
 */
/**
 * Checks that there is just one break per case
 *
 * @category  ControlStructures
 * @author    Laura Thewalt <laura.thewalt@wmdb.de>
 * @author    Stefano Kowalke <blueduck@gmx.net>
 * @copyright 2010 Stefano Kowalke
 * @license   http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @version   Release: @package_version@
 */

namespace ItgalaxyCodingStandards\Sniffs\ControlStructures;

class ValidBreakStatementsInSwitchSniff implements \PHP_CodeSniffer_Sniff
{
    /**
     * A list of tokenizers this sniff supports
     *
     * @var array
     */
    public $supportedTokenizes = ['PHP'];

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_BREAK];
    }
    /**
     * Processes this sniff, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if (array_key_exists('scope_condition', $tokens[$stackPtr]) === false) {
            $conditionPositions = array_keys($tokens[$stackPtr]['conditions']);

            // proof that the parent node is a switch
            if ($tokens[$conditionPositions[0]]['code'] !== T_SWITCH) {
                return;
            }

            $phpcsFile->addError(
                'Too many breaks! Expected one break per case; but found more than one break;',
                $stackPtr
            );
        }
    }
}
