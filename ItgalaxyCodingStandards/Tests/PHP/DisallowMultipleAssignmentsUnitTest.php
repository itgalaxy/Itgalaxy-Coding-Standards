<?php

class ItgalaxyCodingStandards_Tests_PHP_DisallowMultipleAssignmentsUnitTest extends AbstractSniffUnitTest
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
            8 => 1,
            26 => 1,
            32 => 1,
            34 => 1,
            53 => 1,
            91 => 1,
            96 => 1,
            104 => 1
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
