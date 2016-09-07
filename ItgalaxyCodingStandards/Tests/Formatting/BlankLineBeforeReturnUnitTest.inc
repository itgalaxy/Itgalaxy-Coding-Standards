<?php
function test($foo = 1)
{
    return $foo;
}

function validFunctionReturnTwo()
{

    return 'test';
}

function test1()
{
    $foo = 123;

    return $foo;
}

function test2()
{
    $foo = 123;
    return $foo;
}

function test3()
{
    $foo = 1;

    if ($foo == 1) {
        return true;
    } elseif ($foo != 1) {
        return $foo;
    } else {
        return false;
    }
}

function test4()
{
    $foo = 1;

    if ($foo == 1) {
        return true;
    }

    return false;
}

function validFunctionReturnFive()
{
    /**
     * multi-line
     */
    return 'test';
}

function test5()
{
    $foo = 1;

    if ($foo == 1) {
        return true;
    }

    // Comment
    return false;
}

function test6()
{
    $foo = 1;

    if ($foo == 1) {
        return true;
    }
    // Comment
    return false;
}

$condition = true;

switch ($condition) {
    case 'foo':
        return true;
    default:
        return false;
}

function foo()
{
    ?>
        Some string
    <?php
    return;
}
