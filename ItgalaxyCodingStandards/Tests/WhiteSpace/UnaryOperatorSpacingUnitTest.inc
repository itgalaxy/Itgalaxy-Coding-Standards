<?php
$i = 10;

$val = $i--;
$val = $i --;
$val = --$i;
$val = -- $i;
$val = $i++;
$val = $i ++;
$val = ++$i;
$val = ++ $i;

$i = -1;
$i = - 1;
$i = +1;
$i = + 1;

$val = ~$i;
$val = ~ $i;
$val = ~1;
$val = ~ 1;
$val = ~+1;
$val = ~-1;

$val = +1 + +1;
$val = + 1 + + 1;
$val = - 1 + + 1;
$val = + 1 + - 1;
$val = - 1 + - 1;

$val = +1 - +1;
$val = + 1 - + 1;
$val = - 1 - + 1;
$val = + 1 - - 1;
$val = - 1 - - 1;

$array = [
    'i' => -1
];
$array = [
    'i' => - 1
];
$array = [
    'i' => +1
];
$array = [
    'i' => + 1
];

$i = (1 == -1);
$i = (1 == - 1);
$i = (1 === -1);
$i = (1 === - 1);
$i = (1 == +1);
$i = (1 == + 1);
$i = (1 === +1);
$i = (1 === + 1);

$val = range(-50, -45);
$val = range(-50, - 45);
$val = range(-50, -45);
$val = range(- 50, -45);

$val = $i[0] + 1;
$val = $x->{$i} + 1;
$val = !$x;
$val = ! $x;
$val = !($x + $y);
$val = ! ($x + $y);
