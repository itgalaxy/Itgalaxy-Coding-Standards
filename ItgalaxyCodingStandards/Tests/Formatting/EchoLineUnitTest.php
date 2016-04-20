<?php

class ItgalaxyCodingStandards_Tests_Formatting_EchoLineUnitTest extends AbstractSniffUnitTest
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
            32 => 1,
            33 => 1,
            43 => 1,
            45 => 1,
            95 => 1,
            99 => 1,
            105 => 2,
            111 => 1,
            112 => 1,
            146 => 1,
            152 => 1
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
