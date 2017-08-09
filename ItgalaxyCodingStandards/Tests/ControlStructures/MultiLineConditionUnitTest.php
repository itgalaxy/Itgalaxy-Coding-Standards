<?php
namespace ItgalaxyCodingStandards\Tests\ControlStructures;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

class MultiLineConditionUnitTest extends AbstractSniffUnitTest
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
            15 => 1,
            30 => 1,
            31 => 1,
            37 => 1,
            42 => 1,
            44 => 1,
            49 => 1,
            50 => 1,
            57 => 1,
            62 => 1,
            66 => 1,
            67 => 1,
            68 => 2,
            69 => 1,
            70 => 2,
            75 => 1,
            95 => 1,
            96 => 1,
            98 => 1,
            104 => 2,
            117 => 2,
            127 => 1,
            152 => 1,
            160 => 1
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
