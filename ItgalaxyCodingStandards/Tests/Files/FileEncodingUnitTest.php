<?php
namespace ItgalaxyCodingStandards\Tests\Files;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

class ItgalaxyCodingStandards_Tests_Files_FileEncodingUnitTest extends AbstractSniffUnitTest
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
            case 'FileEncodingUnitTest.1.inc':
                return [];
            case 'FileEncodingUnitTest.2.inc':
                return [
                    1 => 1,
                    2 => 1,
                    3 => 1,
                    4 => 1
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
