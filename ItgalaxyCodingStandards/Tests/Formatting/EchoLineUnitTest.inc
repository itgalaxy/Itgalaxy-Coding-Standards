<?php

echo 'test';

$simpleArray = ['test'];

echo $array[0];

$associateArray = [
    'alias' => 'test'
];

echo $associateArray['alias'];

echo [1][0];

echo [
    1,
    2,
    3
][0];

echo [
    'alias' => 'test'
]['alias'];

echo strtoupper('lowercase');

echo str_repeat('test', 5);

echo 'test';
echo 'test', 'test2';
echo ('test'), ('test');
echo 'test' . 'test';

echo 'test';
echo 'test';

print 'test';
echo 'test';

$message = 'Message';
echo $message;

echo $message;
$message = 'Message';
?>
<?php
echo 'test';

$condition = true;

if ($condition) {
    echo 'test';
}

if ($condition) {

    echo 'test';
}

if ($condition) {
    echo 'test';

}

if ($condition) {

    echo 'test';

}

if ($condition) {
    $newMessage = 'newMessage';

    echo $newMessage;
}

if ($condition) {
    echo 'test';

    $newMessage = 'newMessage';
}

if ($condition) {
    $newMessage = 'newMessage';

    echo $newMessage;

    $newMessage = 'reassignNewMessage';
}

if ($condition) {
    $newMessage = 'newMessage';
    echo $newMessage;
}

if ($condition) {
    echo 'test';
    $newMessage = 'newMessage';
}

if ($condition) {
    $newMessage = 'newMessage';
    echo $newMessage;
    $newMessage = 'reassignNewMessage';
}

if ($condition) {
    $newMessage = 'newMessage';
    echo $newMessage;
    echo $newMessage;
    $newMessage = 'reassignNewMessage';
}

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
    default:
        echo 'test';
        break;
}

// Comment
echo 'test';

// Comment
// Comment
echo 'test';

/*
 * Comment
 */
echo 'test';

$message = 'test';
// Comment
echo $message;


$message = 'test';
// Comment
// Comment
echo $message;

echo 'test';
?>
<?php
echo 'test';
exit();

echo 'test';
// Comment

echo 'test';
// Comment

echo 'test';
/*
 * Comment
 */

echo 'test';
