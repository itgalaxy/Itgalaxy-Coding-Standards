<?php
namespace ItgalaxyCodingStandards\Sniffs\CodeAnalysis;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Util\Tokens;

class UnusedFunctionParametersSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_FUNCTION, T_CLOSURE];
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
        $token = $tokens[$stackPtr];

        // Skip broken function declarations.
        if (isset($token['scope_opener']) === false || isset($token['parenthesis_opener']) === false) {
            return;
        }

        $classPtr = $phpcsFile->getCondition($stackPtr, T_CLASS);

        // Ignore extended and implemented method in class
        // Todo implement parsing classes as in `Generic.Classes.DuplicateClassName`
        if ($classPtr !== false) {
            $isAbstractClass = $phpcsFile->findNext(T_ABSTRACT, $classPtr - 1, null, true);

            // Ignore abstract class
            if ($isAbstractClass) {
                return;
            }

            $implements = $phpcsFile->findImplementedInterfaceNames($classPtr);
            $extends = $phpcsFile->findExtendedClassName($classPtr);
            if ($extends !== false || $implements !== false) {
                return;
            }
        }

        $methodParams = $phpcsFile->getMethodParameters($stackPtr);

        // Skip when no parameters found.
        $methodParamsCount = count($methodParams);

        if ($methodParamsCount === 0) {
            return;
        }

        $params = [];

        foreach ($methodParams as $param) {
            $params[$param['name']] = $param['token'];
        }

        $unusedParams = $params;
        $next = ++$token['scope_opener'];
        $end = --$token['scope_closer'];

        $validTokens = [
            T_HEREDOC => T_HEREDOC,
            T_NOWDOC => T_NOWDOC,
            T_END_HEREDOC => T_END_HEREDOC,
            T_END_NOWDOC => T_END_NOWDOC,
            T_DOUBLE_QUOTED_STRING => T_DOUBLE_QUOTED_STRING,
        ];

        $validTokens += Tokens::$emptyTokens;

        for (; $next <= $end; ++$next) {
            $token = $tokens[$next];
            $code = $token['code'];

            // Ignorable tokens.
            if (isset(Tokens::$emptyTokens[$code]) === true) {
                continue;
            }

            if ($code === T_VARIABLE && isset($unusedParams[$token['content']]) === true) {
                unset($unusedParams[$token['content']]);
            } elseif ($code === T_DOLLAR) {
                $nextToken = $phpcsFile->findNext(T_WHITESPACE, $next + 1, null, true);

                if ($tokens[$nextToken]['code'] === T_OPEN_CURLY_BRACKET) {
                    $nextToken = $phpcsFile->findNext(T_WHITESPACE, $nextToken + 1, null, true);

                    if ($tokens[$nextToken]['code'] === T_STRING) {
                        $varContent = '$' . $tokens[$nextToken]['content'];

                        if (isset($unusedParams[$varContent]) === true) {
                            unset($unusedParams[$varContent]);
                        }
                    }
                }
            } elseif ($code === T_DOUBLE_QUOTED_STRING
                || $code === T_START_HEREDOC
                || $code === T_START_NOWDOC
            ) {
                // Tokenize strings that can contain variables.
                // Make sure the string is re-joined if it occurs over multiple lines.
                $content = $token['content'];

                for ($i = ($next + 1); $i <= $end; $i++) {
                    if (isset($validTokens[$tokens[$i]['code']]) === true) {
                        $content .= $tokens[$i]['content'];
                        $next++;
                    } else {
                        break;
                    }
                }

                $stringTokens = token_get_all(sprintf('<?php %s;?>', $content));

                foreach ($stringTokens as $stringPtr => $stringToken) {
                    if (is_array($stringToken) === false) {
                        continue;
                    }

                    $varContent = '';

                    if ($stringToken[0] === T_DOLLAR_OPEN_CURLY_BRACES) {
                        $varContent = '$' . $stringTokens[$stringPtr + 1][1];
                    } elseif ($stringToken[0] === T_VARIABLE) {
                        $varContent = $stringToken[1];
                    }

                    if ($varContent !== '' && isset($unusedParams[$varContent]) === true) {
                        unset($unusedParams[$varContent]);
                    }
                }
            }
        }

        if (count($unusedParams) == 0) {
            return;
        }

        $reversedParams = array_reverse($params);

        foreach ($reversedParams as $paramName => $position) {
            // We found used param in the function, stop the search
            if (!isset($unusedParams[$paramName])) {
                break;
            }

            $error = 'The method parameter %s is never used';
            $data = [$paramName];
            $phpcsFile->addError($error, $position, 'Found', $data);
        }
    }
}
