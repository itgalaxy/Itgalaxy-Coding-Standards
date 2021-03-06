<?php
namespace ItgalaxyCodingStandards\Tests\Strings;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

class NoPlusStringConcatUnitTest extends AbstractSniffUnitTest
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
            3 => 1,
            4 => 1,
            5 => 1,
            7 => 1,
            9 => 1,
            10 => 1,
            12 => 1,
            14 => 1,
            16 => 1,
            18 => 1,
            21 => 1,
            23 => 1,
            27 => 1,
            31 => 1,
            34 => 2
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
