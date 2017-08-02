<?php

function foo($a, $b, $c) {
    return [$a, $b, $c];
}

function fooBar($a , $b,  $c) {
    return [$a, $b,$c];
}

$foo = [$a,$b];
$bar = [$a , $b];
$fooBar = [1,];
$barFoo = [1, ];
