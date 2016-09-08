<?php
$string = 'foo'+'bar';
$string = 'foo'+ 'bar';
$string = 'foo' +'bar';
$string = 'foo' + 'bar';

$string = "foo" + "bar";

$string = 1 + '1';
$string = '1' + 1;

$string = +'foo';

$string = 'foo' + (+123);

$string = 'foo' . 'bar' + 'foobar';

$string = 'foo' + 'bar' . 'foobar';
$string = 1 + 1;
$string = 1 /* test */ + /* test */ 1;
$string = 'foo' /* test */ + /* test */ 'bar';
$string = 'foo' // comment
    +
    //comment
    'bar';
$string = 1 // comment
    +
    //comment
    'bar';
$string = 'foo' // comment
    +
    //comment
    2;
$string = 'foo' + 1 + 2 + 3 + 'bar';
