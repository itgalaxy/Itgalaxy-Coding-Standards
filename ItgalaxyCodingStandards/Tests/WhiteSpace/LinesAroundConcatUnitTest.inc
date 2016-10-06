<?php
$string = 'test';
$string = 'test' . $variable;
$string = $variableFirst . $variableSecond;
$string = 'test' . $variableFirst . $variableSecond;
$string = $variableFirst
    . $variableSecond;
$string = $variableFirst
    . $variableSecond
    . $variableThird;
$string = $variableFirst
    . $variableSecond . $variableThird;
$string = $variableFirst
    . $variableSecond

    . $variableThird;

$string = $variableFirst
    . $variableSecond
    // Comment
    . $variableThird;

$string = $variableFirst
    . $variableSecond

    // Comment
    . $variableThird;

$string = $variableFirst
    . $variableSecond
    // Comment

    . $variableThird;

$string = $variableFirst
    // test
    . $variableSecond;

$string = $variableFirst

    . $variableSecond;

$string = $variableFirst

    . $variableSecond

    . $variableSecond;
