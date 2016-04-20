<?php
function globalFn()
{
    function test()
    {
        return 'test';
    }
}

$a = 1;

if ($a = 1) {
    function test()
    {
        return 'test';
    }
}

if ($a = 1) {
    function test()
    {
        return 'test';
    }
}

if ($a = 1) {
    function test() {
        return 'test';
    }
}
