<?php

class ItgalaxyCodingStandards_Tests_Formatting_DisallowMultipleStatementsUnitTest extends AbstractSniffUnitTest
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
            5 => 1,
            12 => 1,
            23 => 1,
            29 => 1,
            33 => 1,
            34 => 1,
            35 => 2,
            42 => 1,
            47 => 1,
            55 => 1
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
