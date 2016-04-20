<?php

class ItgalaxyCodingStandards_Tests_PHP_AlternativeSyntaxUnitTest extends AbstractSniffUnitTest
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
            9 => 1,
            16 => 1,
            22 => 1,
            28 => 1,
            35 => 1,
            46 => 1,
            55 => 1,
            59 => 1,
            73 => 1,
            87 => 1,
            94 => 1,
            103 => 1
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
