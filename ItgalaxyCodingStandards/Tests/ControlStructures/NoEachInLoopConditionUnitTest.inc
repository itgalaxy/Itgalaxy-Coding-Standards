<?php
$fruit = [
    'a' => 'apple',
    'b' => 'banana',
    'c' => 'cranberry'
];
$dic = [];

reset($fruit);

while (list($key, $val) = each($fruit)) {
    $dic[] = $key . ' = ' . $val;
}

while(true) {}
