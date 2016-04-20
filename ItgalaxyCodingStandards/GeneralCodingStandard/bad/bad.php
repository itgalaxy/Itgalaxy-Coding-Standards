<?php
// Boolean
True;
tRuE;
TRUE;
False;
fAlSe;
FALSE;
Null;
nUlL;
NULL;

// String
$string = 'foo'.'bar';
$string = 'foo' .'bar';
$string = 'foo'. 'bar';
$str = <<<EOD
Пример строки,
охватывающей несколько строчек,
с использованием heredoc-синтаксиса.
EOD;
$str = <<<'EOD'
Пример текста,
занимающего несколько строк,
с помощью синтаксиса nowdoc.
EOD;

// Array
$array = array();
$array = [ ];
$array = [  ];
$array = [
];
$array = [

];
$array = [ 'foo'];
$array = ['foo' ];
$array = [
    'foo'
];
$array = ['foo'
];
$array = [
    'foo'];
$array = [
'foo'];
$array = ['key' => 'foo'];
$array = [ 'key' => 'foo'];
$array = ['key' => 'foo' ];
$array = ['key' => 'foo'
];
$array = [
    'key' => 'foo'];
$array = [
'key' => 'foo'];

// Constants
define('foo', 5);
define('foo_bar', 5);
define('FOO_bar', 5);
define('foo_BAR', 5);
define('fooBar', 5);
define('FooBar', 5);
const constant = 'Здравствуй, мир.';
const constant_constant = 'Здравствуй, мир.';
const CONSTANT_constant = 'Здравствуй, мир.';
const constant_CONSTANT = 'Здравствуй, мир.';
const constantConstant = 'Здравствуй, мир.';
const ConstantConstant = 'Здравствуй, мир.';

// Assignment Operators
$a=1;
$a =1;
$a  =1;
$a= 1;
$a=  1;
$a  =  1;

// Incrementing/Decrementing Operators
$a = 0;
$a --;
-- $a;
$a ++;
++ $a;

// Type Juggling
echo intval(1);
echo floatval(1.1);
echo !!1;
$a = (int) $a;
$a = (integer) $a;
$a = (integer)$a;
$a = (integer)($a);
$a = (integer ) $a;
$a = (integer ) ($a);
$a = ( integer) $a;
$a = ( integer) ($a);
$a = (boolean) $a;
$a = (double) $a;
$a = (real) $a;

// Logical Operators
$a = $a and $a;
$a = $a AND $a;
$a = $a And $a;
$a = $a or $a;
$a = $a OR $a;
$a = $a Or $a;
trySomething() || trySomethingElse();
$success || fail();

// Object Operator
echo $object ->property;
echo $object-> property;
echo $object -> property;
echo $object
->property;
echo $object
        ->property;
echo $object
   ->property;
echo $object
     ->property;
echo $object->property
    ->veryLongNameProperty
    ->veryVeryLongNameProperty;
echo $object->property->veryLongNameProperty
    ->veryVeryLongNameProperty;
echo $object->property->veryLongNameProperty->veryVeryLongNameProperty;
echo $object->method()
    ->veryLongNameMethod()
    ->veryVeryLongNameMethod();
echo $object->method()->veryLongNameMethod()
    ->veryVeryLongNameMethod();
echo $object->method()->veryLongNameMethod()->veryVeryLongNameMethod();

// Ternary Operator
$foo = $bar? : true;
$foo = $bar? :true;
$foo = $bar ? :true;
$foo = $bar ? : true;

$foo = $bar?false :true;
$foo = $bar?false: true;
$foo = $bar?false:true;
$foo = $bar?false : true;

$foo = $bar ?false :true;
$foo = $bar ?false: true;
$foo = $bar ?false:true;
$foo = $bar ?false : true;

$foo = $bar? false :true;
$foo = $bar? false: true;
$foo = $bar? false:true;
$foo = $bar? false : true;

$foo = $bar ? false :true;
$foo = $bar ? false: true;
$foo = $bar ? false:true;

$foo = $bar ? false
    : true;
$foo = $bar
    ? false : true;
$foo = $bar ?
    false
    :
    true;

// echo
echo ('test');
echo('test');
echo'test';

//forbidden function
$a = 1;
is_null($a);
eval('test');

// User-definition function
function fooFoo()
{
    function barBar()
    {
        echo "Я не существую пока не будет вызвана foo().\n";
    }
}

fooFoo();
barBar();
