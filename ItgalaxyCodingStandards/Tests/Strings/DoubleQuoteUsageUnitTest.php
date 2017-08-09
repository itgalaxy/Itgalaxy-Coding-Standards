<?php
namespace ItgalaxyCodingStandards\Tests\Strings;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

class DoubleQuoteUsageUnitTest extends AbstractSniffUnitTest
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
            2 => 1,
            4 => 1,
            5 => 1,
            6 => 2,
            8 => 1,
            9 => 1,
            20 => 1,
            21 => 1,
            25 => 1,
            29 => 1,
            32 => 1,
            34 => 1,
            35 => 1,
            37 => 1,
            38 => 1
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
