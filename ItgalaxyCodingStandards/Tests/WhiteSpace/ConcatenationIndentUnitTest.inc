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

// Todo Must throw error
$string = $variableFirst
    . $variableSecond .
    $variableThird;
