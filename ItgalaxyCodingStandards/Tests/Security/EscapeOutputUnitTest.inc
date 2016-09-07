<?php
echo 'test';

echo $_GET['xss'];

$variable = $_GET['xss'];
echo $variable;

echo $_GET['xssFirst'], $_GET['xssSecond'];

someFunction($_GET['xss']);

echo $_GET['trustedValue'];
// escape ok

echo $condition ? $_GET['xssFirts'] : $_GET['xssSecond'];

vprintf('%04d-%02d-%02d', $_GET['xss']);

$func = function($value) {
    return $value * 2;
};

print_r(array_map($func, range(1, 5)));
echo array_map($func, range(1, 5));
trigger_error($variable);
echo (int) $variable;
echo $variable
    ? $foo
    : $bar;
echo $variable
    ? (int) $foo
    : (int) $bar;

/*
Should accepted
echo (function ():int {
    return 1;
})();
*/
