<?php

class ItgalaxyCodingStandards_Tests_Formatting_SpaceUnaryOperatorUnitTest extends AbstractSniffUnitTest
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
            5 => 1,
            7 => 1,
            9 => 1,
            11 => 1,
            14 => 1,
            16 => 1,
            19 => 1,
            21 => 1,
            26 => 2,
            27 => 2,
            28 => 2,
            29 => 2,
            32 => 2,
            33 => 2,
            34 => 2,
            35 => 2,
            41 => 1,
            47 => 1,
            51 => 1,
            53 => 1,
            55 => 1,
            57 => 1,
            60 => 1,
            62 => 1,
            67 => 1,
            69 => 1
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
