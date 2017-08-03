<?php

class ItgalaxyCodingStandards_Tests_Formatting_CommaDangleUnitTest extends AbstractSniffUnitTest
{
    /**
     * Returns the lines where errors should occur.
     *
     * The key of the array should represent the line number and the value
     * should represent the number of errors that should occur on that line.
     *
     * @return array<int, int>
     */
    public function getErrorList($testFile = '')
    {
        switch ($testFile) {
            case 'CommaDangleUnitTest.1.inc':
                return [
                    4 => 1,
                    6 => 1,
                    9 => 1,
                    10 => 1,
                    13 => 1,
                    15 => 1,
                    23 => 1,
                    25 => 1,
                    26 => 1,
                    29 => 1,
                    33 => 1,
                    37 => 1
                ];
            case 'CommaDangleUnitTest.2.inc':
                return [
                    4 => 1,
                    6 => 1,
                    9 => 1,
                    10 => 1,
                    13 => 1,
                    15 => 1,
                    23 => 1,
                    25 => 1,
                    26 => 1,
                    29 => 1,
                    33 => 1,
                    37 => 1
                ];
            case 'CommaDangleUnitTest.3.inc':
                return [
                    2 => 1,
                    6 => 1,
                    13 => 1,
                    22 => 1,
                    28 => 1,
                    36 => 1,
                    41 => 1,
                    44 => 1,
                    47 => 1,
                    56 => 1
                ];
            default:
                return [];
        }
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
