<?php
// For all function (include strpos) used same logic
$myString = 'abc';
$findMe = 'a';

// To know that a substring is absent
if ($pos = strpos($myString, $findMe) === false) {
    $output = 'String '
        . $findMe
        . ' not found in string '
        . $myString;
}

// To know that a substring is present (in any position including 0)
if ($pos = strpos($myString, $findMe) !== false) {
    $output = 'String '
        . $findMe
        . ' found in string '
        . $myString
        . 'at position'
        . $pos;
}

// To know that a substring is at the start of the string
if ($pos = strpos($myString, $findMe) === 0) {
    $output = 'String '
        . $findMe
        . ' found in string '
        . $myString
        . 'at position'
        . $pos;
}

// To know that a substring is at the 1 index of the string
if ($pos = strpos($myString, $findMe) === 1) {
    $output = 'String '
        . $findMe
        . ' found in string '
        . $myString
        . 'at position'
        . $pos;
}

if (strpos($myString, $findMe) > 0) {
    $output = 'Error';
}

if (strpos($myString, $findMe) < 0) {
    $output = 'Error';
}

if (strpos($myString, $findMe) >= 0) {
    $output = 'Error';
}

if (strpos($myString, $findMe) <= 0) {
    $output = 'Error';
}

if (strpos($myString, $findMe) == 0) {
    $output = 'Error';
}
