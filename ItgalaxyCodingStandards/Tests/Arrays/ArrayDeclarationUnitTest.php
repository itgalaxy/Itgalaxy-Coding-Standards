<?php

class ItgalaxyCodingStandards_Tests_Arrays_ArrayDeclarationUnitTest extends AbstractSniffUnitTest
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
            case 'ArrayDeclarationUnitTest.1.inc':
                return [
                    7 => 2,
                    9 => 2,
                    19 => 1,
                    22 => 1,
                    32 => 1,
                    35 => 1,
                    37 => 1,
                    42 => 1,
                    50 => 1,
                    58 => 1,
                    62 => 1,
                    66 => 2,
                    68 => 1,
                    76 => 2,
                    77 => 1,
                    78 => 6,
                    79 => 2,
                    87 => 1,
                    88 => 1,
                    92 => 1,
                    97 => 1,
                    100 => 2,
                    101 => 1,
                    102 => 2,
                    105 => 2,
                    107 => 1,
                    112 => 1,
                    115 => 1,
                    118 => 1,
                    132 => 1,
                    138 => 1,
                    144 => 1,
                    146 => 1,
                    148 => 1,
                    151 => 1,
                    163 => 1,
                    169 => 1,
                    173 => 2,
                    174 => 2,
                    141 => 1,
                    182 => 1,
                    185 => 1,
                    188 => 1,
                    191 => 1,
                    195 => 1,
                    197 => 1,
                    200 => 1,
                    207 => 1,
                    211 => 1,
                    213 => 1,
                    218 => 1,
                    219 => 1,
                    229 => 1,
                    231 => 1,
                    237 => 1,
                    243 => 1,
                    249 => 1,
                    261 => 1,
                    266 => 1,
                    271 => 1,
                    275 => 1,
                    277 => 1,
                    281 => 1,
                    283 => 1,
                    285 => 1,
                    289 => 1,
                    290 => 1,
                    295 => 1,
                    301 => 1,
                    319 => 1,
                    329 => 1,
                    338 => 1,
                    343 => 1,
                    347 => 1,
                    348 => 1,
                    349 => 2,
                    354 => 1
                ];
            case 'ArrayDeclarationUnitTest.2.inc':
                return [
                    9 => 1,
                    19 => 1,
                    32 => 1,
                    37 => 1,
                    42 => 1,
                    66 => 1,
                    68 => 1,
                    76 => 1,
                    77 => 1,
                    78 => 6,
                    79 => 2,
                    87 => 1,
                    88 => 1,
                    92 => 1,
                    97 => 1,
                    100 => 2,
                    101 => 1,
                    102 => 2,
                    105 => 2,
                    107 => 1,
                    112 => 1,
                    115 => 1,
                    118 => 1,
                    132 => 1,
                    138 => 1,
                    141 => 1,
                    144 => 1,
                    146 => 1,
                    148 => 1,
                    151 => 1,
                    163 => 1,
                    169 => 1,
                    173 => 2,
                    174 => 2,
                    185 => 1,
                    191 => 1,
                    195 => 1,
                    197 => 1,
                    200 => 1,
                    207 => 1,
                    221 => 1,
                    223 => 1,
                    229 => 1,
                    235 => 1,
                    241 => 1,
                    253 => 1,
                    258 => 1,
                    263 => 1,
                    267 => 1,
                    269 => 1,
                    273 => 1,
                    275 => 1,
                    277 => 1,
                    281 => 1,
                    282 => 1,
                    287 => 1,
                    293 => 1,
                    311 => 1,
                    321 => 1,
                    339 => 1,
                    340 => 1,
                    341 => 2,
                    346 => 1
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
