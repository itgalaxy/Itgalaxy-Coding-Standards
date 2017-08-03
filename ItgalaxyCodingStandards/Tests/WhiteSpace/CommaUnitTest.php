<?php

class ItgalaxyCodingStandards_Tests_WhiteSpace_CommaUnitTest extends AbstractSniffUnitTest
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
            7 => 2,
            8 => 1,
            11 => 1,
            12 => 1,
            23 => 1,
            29 => 1,
            34 => 1,
            39 => 1,
            44 => 1,
            48 => 1,
            49 => 1,
            51 => 1,
            53 => 1,
            57 => 1,
            62 => 2,
            67 => 1,
            82 => 1,
            87 => 1,
            98 => 1,
            101 => 1
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
