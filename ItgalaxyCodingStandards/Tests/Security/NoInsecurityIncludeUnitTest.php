<?php
namespace ItgalaxyCodingStandards\Tests\Security;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

class NoInsecurityIncludeUnitTest extends AbstractSniffUnitTest
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
            44 => 1,
            45 => 1,
            46 => 1,
            47 => 1,
            48 => 1,
            49 => 1,
            50 => 1,
            52 => 1,
            53 => 1,
            54 => 1,
            55 => 1,
            56 => 1,
            57 => 1,
            58 => 1,
            60 => 1,
            61 => 1,
            62 => 1,
            63 => 1,
            64 => 1,
            65 => 1,
            66 => 1,
            68 => 1,
            69 => 1,
            70 => 1,
            71 => 1,
            72 => 1,
            73 => 1,
            74 => 1,
            76 => 1,
            77 => 1,
            78 => 1,
            79 => 1,
            80 => 1,
            81 => 1,
            82 => 1,
            84 => 1,
            85 => 1,
            86 => 1,
            87 => 1,
            88 => 1,
            89 => 1,
            90 => 1,
            92 => 1,
            93 => 1,
            94 => 1,
            95 => 1,
            96 => 1,
            97 => 1,
            98 => 1,
            100 => 1,
            101 => 1,
            102 => 1,
            103 => 1,
            104 => 1,
            105 => 1,
            106 => 1
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
