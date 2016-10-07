<?php
function globalFn()
{
    function test()
    {
        return 'test';
    }
}

$a = 1;

if ($a == 1) {
    function test()
    {
        return 'test';
    }
}

if ($a == 1) {
    function test()
    {
        return 'test';
    }
}

if ($a == 1) {
    function test() {
        return 'test';
    }
}

function test()
{
    echo 'test';

}

if ($a == 1) {
    function test() {
        return 'test';

    }
}

function test()
{
    function closure() {
        echo 'test';

    }
}

function test()
{
    function closure() {
        echo 'test'; }
}

function test()
{
    function closure() { echo 'test'; }
}

interface iTemplate
{
    public function setVariable($name, $var);
    public function getHtml($template);
}
