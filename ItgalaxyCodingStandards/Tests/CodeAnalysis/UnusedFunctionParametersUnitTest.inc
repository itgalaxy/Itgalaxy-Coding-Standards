<?php

class Foo {
    public function run($one, $two) {
        return $one * $two;
    }
}

class Bar extends Foo {
    public function run($one, $two) {
        return $one;
    }
}

class FooBar extends Bar {
    public function run($one, $two) {
        $result = $one * 2;

        return $result;
    }
}

function foo($a, $b) {
    return $a * 2;
}

function baz($a, $b) {
    echo "baz({$a});";
}

function bar($a, $b) {
    $x = $b;

    for ($i = 0; $i <$a; $i++) {
        $x += $a * $i;
    }

    return $x;
}

function foobar($a, &$b) {
    return (preg_match('/foo/', $a, $b) !== 0);
}

class Foo {
    function barfoo(string $a, string $b) {
        return $a . $b;
    }

    function fooBar(int $a, int $b) {
        return $a + $b;
    }
}

function foo($bar)
{
    print <<<BAZ
    $bar
BAZ
}

function foo($parameter) {
    $wango = <<<HERE
1 Must be a HEREdoc of at least one line
HERE;
    $x = $parameter; // This line must be immediately after the HERE; with no intervening blank lines.
    $tango = <<<HERE
1 Must be a HEREdoc
2
3
4
5
6
7
8
9 at least 9 lines long
HERE;
}

function foo( $parameter ) {
    return <<<HTML
<?xml version="1.0"?>
<value>$parameter</value>
HTML;
}

print foo('PARAMETER');
print "\n";

function foo($bar)
{
    print "${bar} things\n";
}

function bar($x)
{
    return 2 * ${x};
}

function testThird() {
    throw new Exception('Exception');
}

function testFourth() {
    return;
}

function testFourth() {
    return $a;
}

function testFifth($a) {
    return $a;
}

class Foo
{
    public abstract function foo($bar);
}

add(function () {
    return ?> <? echo 'foo'; ?><?php
});

function foo($b, $a) {
    return $a * 2;
}

$foo = function ($a) {
    return 'foo';
};

function fooBarFoo($b) {
    return 'bar';
}

$bar = function ($b, $a) {
    return $a * 2;
};

function ($a, $b, $c, $d) {
    return $a + $c;
}
