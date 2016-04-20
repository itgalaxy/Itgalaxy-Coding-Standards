<?php

class ItgalaxyCodingStandards_Tests_PHP_PHPTagUnitTest extends AbstractSniffUnitTest
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
            1 => 1,
            4 => 1,
            9 => 2,
            10 => 1,
            11 => 1,
            12 => 1,
            13 => 1,
            16 => 1,
            20 => 1,
            21 => 1,
            29 => 1,
            30 => 1,
            31 => 1,
            32 => 2,
            34 => 2,
            35 => 1
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
