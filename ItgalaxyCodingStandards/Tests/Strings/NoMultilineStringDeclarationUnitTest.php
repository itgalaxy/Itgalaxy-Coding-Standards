<?php
namespace ItgalaxyCodingStandards\Tests\Strings;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

class NoMultilineStringDeclarationUnitTest extends AbstractSniffUnitTest
{
    /**
     * Returns the lines where errors should occur.
     *
     * The key of the array should represent the line number and the value
     * should represent the number of errors that should occur on that line.
     *
     * @return array<int, int>
     */
    public function getErrorList()
    {
        return [
            3 => 1,
            4 => 1,
            5 => 1,
            6 => 1,
            7 => 1,
            10 => 1,
            11 => 1
        ];
    }

    /**
     * Returns the lines where warnings should occur.
     *
     * The key of the array should represent the line number and the value
     * should represent the number of warnings that should occur on that line.
     *
     * @return array<int, int>
     */
    public function getWarningList()
    {
        return [];
    }
}
