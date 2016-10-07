<?php

class ItgalaxyCodingStandards_Tests_WhiteSpace_OperatorSpacingUnitTest extends AbstractSniffUnitTest
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
            4 => 1,
            5 => 2,
            8 => 1,
            9 => 1,
            10 => 2,
            13 => 1,
            14 => 1,
            15 => 2,
            18 => 1,
            19 => 1,
            20 => 2,
            23 => 1,
            24 => 1,
            25 => 2,
            28 => 1,
            29 => 1,
            30 => 2,
            33 => 1,
            34 => 1,
            35 => 2,
            38 => 1,
            39 => 1,
            40 => 2,
            43 => 1,
            44 => 1,
            45 => 2,
            48 => 1,
            49 => 1,
            50 => 2,
            53 => 1,
            54 => 1,
            55 => 2,
            58 => 1,
            59 => 1,
            60 => 2,
            63 => 1,
            64 => 1,
            65 => 2,
            68 => 1,
            69 => 1,
            70 => 2,
            73 => 1,
            74 => 1,
            75 => 2,
            77 => 1,
            78 => 2,
            79 => 2,
            80 => 3,
            82 => 1,
            83 => 2,
            84 => 2,
            85 => 3,
            87 => 2,
            88 => 3,
            89 => 3,
            90 => 4,
            96 => 2,
            100 => 2,
            101 => 1,
            118 => 1,
            119 => 2,
            120 => 1,
            121 => 1,
            122 => 2,
            125 => 1,
            126 => 2,
            127 => 1,
            128 => 1,
            129 => 2,
            132 => 1,
            133 => 2,
            134 => 1,
            135 => 1,
            136 => 2,
            139 => 1,
            140 => 2,
            141 => 1,
            142 => 1,
            143 => 2,
            146 => 1,
            147 => 2,
            148 => 1,
            149 => 1,
            150 => 2,
            154 => 2,
            156 => 2,
            158 => 2,
            159 => 1,
            160 => 2,
            167 => 4,
            168 => 3,
            173 => 10,
            177 => 1,
            178 => 1,
            191 => 4,
            192 => 1,
            193 => 1,
            194 => 2,
            195 => 1,
            198 => 6,
            199 => 6,
            201 => 4,
            202 => 5,
            204 => 4,
            205 => 5,
            242 => 4,
            285 => 1,
            299 => 1,
            300 => 1,
            304 => 3,
            316 => 1,
            317 => 1
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
