<?php
$foo = boolval(null);

// 42
$foo = intval(42);
// 4
$foo = intval(4.2);
// 42
$foo = intval('42');
// 42
$foo = intval('+42');
// -42
$foo = intval('-42');
// 34
$foo = intval(042);
// 42
$foo = intval('042');
// 1410065408
$foo = intval(1e10);
// 1
$foo = intval('1e10');
// 26
$foo = intval(0x1A);
// 42000000
$foo = intval(42000000);
// 0
$foo = intval(420000000000000000000);
// 2147483647
$foo = intval('420000000000000000000');
// 42
$foo = intval(42, 8);
// 34
$foo = intval('42', 8);
// 0
$foo = intval(array());
// 1
$foo = intval(array('foo', 'bar'));

$foo = '122.34343The';
$float_value_of_var = floatval($foo);

$foo = 'The122.34343';
$float_value_of_var = floatval($foo);

$foo = strval(123);

$foo = null;

$double = doubleval($foo);

$foo = (int) ('123');
$foo = (float) ('123');
$foo = (bool) ('123');
$foo = (string) (123);
$bar = true;
$foo = settype($bar, 'integer');
