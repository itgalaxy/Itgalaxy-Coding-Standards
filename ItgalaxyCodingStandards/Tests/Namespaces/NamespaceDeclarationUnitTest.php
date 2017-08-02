<?php

class ItgalaxyCodingStandards_Tests_Namespaces_NamespaceDeclarationUnitTest extends AbstractSniffUnitTest
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
            case 'NamespaceDeclarationUnitTest.1.inc':
                return [];
            case 'NamespaceDeclarationUnitTest.2.inc':
                return [3 => 2];
            case 'NamespaceDeclarationUnitTest.3.inc':
                return [4 => 2];
            case 'NamespaceDeclarationUnitTest.4.inc':
                return [1 => 1];
            case 'NamespaceDeclarationUnitTest.5.inc':
                return [3 => 2];
            case 'NamespaceDeclarationUnitTest.6.inc':
                return [];
            case 'NamespaceDeclarationUnitTest.7.inc':
                return [2 => 1];
            case 'NamespaceDeclarationUnitTest.8.inc':
                return [2 => 1];
            case 'NamespaceDeclarationUnitTest.9.inc':
                return [];
            case 'NamespaceDeclarationUnitTest.10.inc':
                return [];
            case 'NamespaceDeclarationUnitTest.11.inc':
                return [];
            case 'NamespaceDeclarationUnitTest.12.inc':
                return [2 => 1];
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
