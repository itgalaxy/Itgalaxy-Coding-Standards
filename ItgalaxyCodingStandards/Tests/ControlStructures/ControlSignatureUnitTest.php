<?php
namespace ItgalaxyCodingStandards\Tests\ControlStructures;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

class ControlSignatureUnitTest extends AbstractSniffUnitTest
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
            3 => 1,
            7 => 1,
            12 => 1,
            15 => 1,
            18 => 2,
            20 => 1,
            22 => 2,
            28 => 2,
            32 => 2,
            38 => 2,
            42 => 2,
            48 => 2,
            52 => 2,
            62 => 2,
            66 => 4,
            76 => 4,
            80 => 4,
            82 => 1,
            86 => 1,
            90 => 1,
            94 => 1,
            95 => 1,
            99 => 1,
            108 => 2,
            112 => 1,
            115 => 1,
            120 => 1,
            122 => 2,
            123 => 1,
            130 => 2,
            134 => 1,
            150 => 1,
            151 => 1,
            153 => 1,
            154 => 1,
            158 => 2,
            163 => 1,
            165 => 1,
            170 => 2,
            186 => 2,
            187 => 2,
            225 => 1,
            231 => 1,
            240 => 1,
            254 => 1,
            260 => 2,
            272 => 1,
            278 => 1,
            284 => 3,
            290 => 2,
            296 => 2,
            302 => 2,
            316 => 1,
            326 => 1,
            330 => 1,
            335 => 1,
            337 => 8,
            339 => 2,
            340 => 2,
            343 => 6,
            344 => 2,
            346 => 1,
            348 => 1,
            350 => 1,
            351 => 3,
            352 => 2,
            354 => 1,
            357 => 2,
            363 => 2
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
