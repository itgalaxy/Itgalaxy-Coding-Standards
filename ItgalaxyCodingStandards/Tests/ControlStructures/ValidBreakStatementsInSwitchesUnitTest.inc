<?php
$i = 1;

switch ($i) {
    case 0:
        echo 'i равно 0';
        break;
    case 1:
        echo 'i равно 1';
        break;
    case 2:
        echo 'i равно 2';
        break;
    default:
        echo '?';
        break;
}

switch ($i) {
    case 0:
        echo 'i равно 0';
        break;
    case 1:
        echo 'i равно 1';
        break;
        break;
    case 2:
        echo 'i равно 2';
        break;
    default:
        echo '?';
        break;
}

switch ($i) :
    case 0:
        echo 'i равно 0';
        break;
    case 1:
        echo 'i равно 1';
        break;
        break;
    case 2:
        echo 'i равно 2';
        break;
    default:
        echo 'i не равно to 0, 1 или 2';
endswitch;
