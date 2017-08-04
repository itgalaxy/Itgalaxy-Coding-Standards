<?php

class ItgalaxyCodingStandards_Tests_Namespaces_UseDeclarationUnitTest extends AbstractSniffUnitTest
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
            case 'UseDeclarationUnitTest.1.inc':
                return [];
            case 'UseDeclarationUnitTest.2.inc':
                return [4 => 2];
            case 'UseDeclarationUnitTest.3.inc':
                return [4 => 2];
            case 'UseDeclarationUnitTest.4.inc':
                return [
                    4 => 1,
                    5 => 1
                ];
            case 'UseDeclarationUnitTest.5.inc':
                return [];
            case 'UseDeclarationUnitTest.6.inc':
                return [];
            case 'UseDeclarationUnitTest.7.inc':
                return [];
            case 'UseDeclarationUnitTest.8.inc':
                return [];
            case 'UseDeclarationUnitTest.9.inc':
                return [];
            case 'UseDeclarationUnitTest.10.inc':
                return [];
            case 'UseDeclarationUnitTest.11.inc':
                return [];
            case 'UseDeclarationUnitTest.12.inc':
                return [];
            case 'UseDeclarationUnitTest.13.inc':
                return [5 => 1];
            case 'UseDeclarationUnitTest.14.inc':
                return [6 => 2];
            case 'UseDeclarationUnitTest.15.inc':
                return [];
            case 'UseDeclarationUnitTest.16.inc':
                return [1 => 2];
            case 'UseDeclarationUnitTest.17.inc':
                return [];
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
