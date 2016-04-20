<?php

class ItgalaxyCodingStandards_Tests_Strings_EmbeddedVariablesUnitTest extends AbstractSniffUnitTest
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
            7 => 1,
            10 => 1,
            14 => 1,
            18 => 1,
            23 => 2,
            24 => 1,
            25 => 1,
            27 => 1
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
