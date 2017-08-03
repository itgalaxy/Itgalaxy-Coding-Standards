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

$fooArray = [
    'foo' => '',
    'bar' => 'thumbnail',
];

$barArray = [
    'foo' => ''
,
    'bar' => 'thumbnail'
];

$barArray = [
    'foo' => ''
    ,
    'bar' => 'thumbnail'
];

$foobarArray = [
    'foo' => 1 ,
    'bar' => 2
];

$foobarArray = [
    'foo' => 1  ,
    'bar' => 2
];

$foobarArray = [
    'foo' => 1	,
    'bar' => 2
];

$barbarfooArray = [1,	2];
$bbar = [1,/* test */2];
$bbar = [1, /* test */2];
$ffoo = [1,(bool) 2];
$ffoo = [1, (bool) 2];
$ffoo = [1,  (bool) 2];

$barArray = [
    'foo' => ''
    , 'bar' => 'thumbnail'
];

$barArray = [
    'foo' => ''
    ,'bar' => 'thumbnail'
];

$foobarArray = [
    'foo' => 1,
    'bar' => 2,/* test */
];

$foobarArray = [
    'foo' => 1,
    'bar' => 2,
    /* test */
];

$barArray = [
    'foo' => ''/* test */, /*test */
    'bar' => 'thumbnail'
];

$barArray = [
    'foo' => ''/* test */,/*test */
    'bar' => 'thumbnail'
];

$foobarArray = [
    'foo' => 1,/* test */
    'bar' => 2,
];

$foobarArray = [
    'foo' => 1, /* test */
    'bar' => 2,
];

$bbar = [1/* test */,];
$bbar = [1
,];

$bbar = [1
    ,];

$foobarArray = [
    'foo' => 1,
    'bar' => 2,];

$foobarArray = ['foo' => 1, 'bar' => 2,];
$foobarArray = ['foo' => 1, 'bar' => 2, ];
$foobarArray = ['foo' => 1, 'bar' => 2, /* test */];
