<?php
namespace ItgalaxyCodingStandards\Sniffs\Classes;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

/**
 * Checks that class references do not use FQN but use statements.
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */
class FullyQualifiedNamespaceSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_NS_SEPARATOR];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Sniffs\Sniff $phpcsFile The PHP_CodeSniffer file where the token was found.
     * @param int                           $stackPtr  The position in the PHP_CodeSniffer
     *                                                 file's token stack where the token was found.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        // We are only interested in a backslash embedded between strings, which
        // means this is a class reference with more than once namespace part.
        if ($tokens[$stackPtr - 1]['code'] !== T_STRING || $tokens[$stackPtr + 1]['code'] !== T_STRING) {
            return;
        }

        // Check if this is a use statement and ignore those.
        $before = $phpcsFile->findPrevious([T_STRING, T_NS_SEPARATOR, T_WHITESPACE], $stackPtr, null, true);

        if ($tokens[$before]['code'] === T_USE || $tokens[$before]['code'] === T_NAMESPACE) {
            return;
        }

        // If this is a namespaced function call then ignore this because use
        // statements for functions are not possible in PHP 5.5 and lower.
        $after = $phpcsFile->findNext([T_STRING, T_NS_SEPARATOR, T_WHITESPACE], $stackPtr, null, true);

        if ($tokens[$after]['code'] === T_OPEN_PARENTHESIS && $tokens[$before]['code'] !== T_NEW) {
            return $after + 1;
        }

        $error = 'Namespaced classes/interfaces/traits should be referenced with use statements';

        $fix = $phpcsFile->addFixableError($error, $stackPtr, 'UseStatementMissing');

        if ($fix === true) {
            $fullName = $phpcsFile->getTokensAsString($before + 1, $after - 1 - $before);
            $fullName = trim($fullName, '\ ');
            $phpcsFile->fixer->beginChangeset();

            // Replace the fully qualified name with the local name.
            for ($i = ($before + 1); $i < $after; $i++) {
                if ($tokens[$i]['code'] !== T_WHITESPACE) {
                    $phpcsFile->fixer->replaceToken($i, '');
                }
            }

            $parts = explode('\\', $fullName);
            $className = end($parts);
            $phpcsFile->fixer->addContentBefore($after - 1, $className);

            // Check if there is a use statement already for this class and namespace.
            $alreadyUsed = false;
            $useStatement = $phpcsFile->findNext(T_USE, 0);

            while ($useStatement !== false && empty($tokens[$useStatement]['conditions']) === true) {
                $useEnd = $phpcsFile->findEndOfStatement($useStatement);
                $classRef = trim($phpcsFile->getTokensAsString(($useStatement + 1), ($useEnd - 1 - $useStatement)));

                if (strcasecmp($classRef, $fullName) === 0) {
                    $alreadyUsed = true;
                    break;
                }

                $useStatement = $phpcsFile->findNext(T_USE, ($useEnd + 1));
            }

            // @todo Check if the name is already in use - then we need to alias it.
            // Insert use statement at the beginning of the file if it is not there
            // already. Also check if another sniff (for example
            // UnusedUseStatementSniff) has already deleted the use statement, then
            // we need to add it back.
            if ($alreadyUsed === false
                || $phpcsFile->fixer->getTokenContent($useStatement) !== $tokens[$useStatement]['content']
            ) {
                // Check if there is a group of use statements and add it there.
                $useStatement = $phpcsFile->findNext(T_USE, 0);

                if ($useStatement !== false && empty($tokens[$useStatement]['conditions']) === true) {
                    $phpcsFile->fixer->addContentBefore($useStatement, "use $fullName;\n");
                } else {
                    // Check if there is an @file comment.
                    $beginning = 0;
                    $fileComment = $phpcsFile->findNext(T_WHITESPACE, ($beginning + 1), null, true);
                    if ($tokens[$fileComment]['code'] === T_DOC_COMMENT_OPEN_TAG) {
                        $beginning = $tokens[$fileComment]['comment_closer'];
                    }
                    $phpcsFile->fixer->addContent($beginning, "use $fullName;\n");
                }
            }

            $phpcsFile->fixer->endChangeset();
        }

        return $phpcsFile->findNext([T_STRING, T_NS_SEPARATOR], ($stackPtr + 1), null, true);
    }
}
