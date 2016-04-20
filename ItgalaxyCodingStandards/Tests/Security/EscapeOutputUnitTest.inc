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
