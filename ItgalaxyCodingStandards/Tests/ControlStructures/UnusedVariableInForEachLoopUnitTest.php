<?php

class ItgalaxyCodingStandards_Tests_ControlStructures_UnusedVariableInForEachLoopUnitTest extends AbstractSniffUnitTest
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
            13 => 1,
            21 => 1,
            25 => 1,
            32 => 1,
            38 => 1,
            41 => 1,
            48 => 1,
            54 => 1,
            57 => 1,
            66 => 1,
            74 => 1,
            81 => 1,
            87 => 1,
            94 => 1,
            100 => 1,
            111 => 1,
            115 => 1,
            123 => 2
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
