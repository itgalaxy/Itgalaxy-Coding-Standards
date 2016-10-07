<?php
$array = [1,2];
$array = [1,2,3];
$array = [1,  2];
$array = [1,  2,  4];

function test($arg1 = 1,$arg2 = 2) {
    return $arg1 + $arg2;
}

function test1($arg1 = 1,$arg2 = 2,$arg3 = 3) {
    return $arg1 + $arg2 + $arg3;
}

echo 'foo','bar';
echo 'foo'/* test */, $bar;
echo 'foo', /* test */$bar;
echo 'foo',/* test */$bar;

$array = [
    1, 2,
    3,4
    ,5,6,
    7,
];
