<?php
// Todo fix
$object
    ->test
    ->test
    ->test()


    ->test();

$object[1]
    ->method()
    ->veryLongNameMethod()
    ->veryVeryLongNameMethod();

$object
    ->method()
    ->veryLongNameMethod()
    ->veryVeryLongNameMethod();

$test
    ->test()
    ->test()
    ->test();

$test
    ->test()
    ->test()
    ->test();

$test->test()
    ->test()
    ->test();

$test
    ->test()
    ->test()
    ->test();

// Todo start indent
    $a = 1;

// Todo fix
echo $order->email_order_items_table(
    $order->has_status('processing'),
    !'test',
    $order->has_status('processing')
);
?>
<?php
// Todo string indention
$test = 'test'
    . 'test';

echo '<option value="'
    . esc_attr(
        $term
            ->slug1
            ->slug2
            ->slug3 . $term->slug
    )
    . '" '
    . htmlspecialchars(selected(
        sanitize_title($selected_value),
        sanitize_title($term->slug),
        false
    ))
    . '>'
    . htmlspecialchars(apply_filters(
        'woocommerce_variation_option_name',
        $term->name
    ))
    . '</option>';

// Todo mutiple arguments in call function

// Todo blank lines before and after properties and methods

// Todo blank lines before function and after

// Todo blank line before return and before comment before return

// Boolean
true;
false;
null;

// Integers
$a = 1234;
$a = +1234;
$a = -123;
$a = 0123;
$a = 0x1A;
$a = 0b11111111;
$a = 2147483647 - 2147483647 + 2147483647 - 2147483647 + 2147483647 - 2147483647 + 2147483647 - 2147483647 + 2147483647
    - 2147483647
    + 2147483647;

// Floating point numbers
$a = !1.234;
$b = 1.2e3;
$c = 7E-10;

// String
$string = 'Yes, Please';
$escape = 'Однажды Арнольд сказал: "I\'ll be back"';
$markup = 'Some markup text<br/>';
$markupHTML5 = 'Some markup text with allowed HTML5 <br> tag';
$x = 'This string is very long and thus it can and should be concatenated.'
    . 'Othverwise the string will be very hard to maintain and or read';
$x = 'This string should be concatenated. Even if it is just a little bit '
    . 'longer';
$x = (1 + 2 + 3 + 4 + 5 + 6 + 7 + 8 + 9 + 10 + 11 + 12 + 13 + 14 + 15 + 16 + 17 + 18 + 19 + 20 + 21 + 22 + 23 + 24 + 25)
    . 'This is initially '
    . 'short but since it has a lot of code before the real text it can be '
    . 'concatenated';
$message = (int) ('100')
    + (int) ('1');

// Array
$array = [];
$array = ['foo'];
$array = [
    'foo' => 'bar'
];
$array = [
    'foo' => 'bar',
    'bar' => 'foo'
];
$array = [
    'foo',
    'bar'
];
$array = [
    1 => 'a',
    '2' => 'b',
    PHP_INT_MAX => 1,
    '4' => $a + 1,
    '5' => $a . '2'
];
$array = [
    '1',
    '2',
    ['3']
];
$array = [
    '1',
    '2',
    [
        'one',
        'two',
        'three',
        [
            'key' => $array,
            'title' => 'test',
            'index' => $a + 1,
            'indexString' => $a . 'test'
        ]
    ]
];
$array = [
    'value' => 12,
    'name' => 'example_a',
    'title' => 'Example A',
    'xml' =>
        '<foo>'
        . '<bar>'
        . '123456789 123456789 123456789 123456789 123456789 123456789 123456789'
        . '123456789 123456789 123456789 123456789 123456789 123456789 123456789'
        . '</bar>'
        . '</foo>'
];

if (in_array('1', [
    '1',
    '2',
    '3'
]) === true) {
    $value = in_array('1', [
        '1',
        '2',
        '3',
        '4'
    ]);
}

$array = [
    'first',
    'second'
    // 'third',
];

$array = [
    'key1' => function ($bar) {
        return $bar;
    },
    'key2' => function ($foo) {
        return $foo;
    },
    'key3' => function ($bar) {
        return $bar;
    }
];

// null
$null = null;

// Constants
define('FOO_BAR', 5);
const CONSTANT = 'Здравствуй, мир.';

// Arithmetic Operators
$a = -$a;
$a = !$a;
$a = $a + $b;
$a = $a - $b;
$a = $a * $b;
$a = $a / $b;
$a = $a % $b;
$a = $a ** $b;

// Assignment Operators
$a = (2 * 1) + $a;
$a = 3;
$a += 5;
$b = 'Hello ';
$b .= 'There!';
$longNameStringVariableWithLongValue
    = 'Long text. Long text. Long text. Long text. Long text. Long text. Long text. Long text. Long text. Long text';
$veryLongNameStringVariableWithLongValue
    = 'Long text. Long text. Long text. Long text. Long text. Long text. Long text. Long text. Long text. Long text'
    . 'Long text';

$a = 3;
// $b is a reference to $a
$b = &$a;

// prints 3
echo (int) ($a);

// prints 3
echo (int) ($b);

// change $a
$a = 4;

// prints 4
echo (int) ($a);

// prints 4 as well, since $b is a reference to $a, which ha
echo (int) ($b);
// been changed

$a = 0;
$a += 0;
$a -= 0;
$a *= 0;
$a /= 0;
$a %= 0;

// Bitwise Operators
$a = $a & $b;
$a = $a | $b;
$a = $a ^ $b;
$a = ~$a;
$a = $a << $b;
$a = $a >> $b;
$a &= $b;
$a |= $b;
$a ^= $b;
$a <<= $b;
$a >>= $b;

// Comparison Operators
$a = $a == $b;
$a = $a === $b;
$a = $a != $b;
$a = $a !== $b;
$a = $a < $b;
$a = $a > $b;
$a = $a >= $b;
$a = $a <= $b;
$longBooleanVariable = 1;
$a = $longBooleanVariable == 1 && $longBooleanVariable == 1 && $longBooleanVariable == 1 && $longBooleanVariable == 1
    && $longBooleanVariable == 1;

// Incrementing/Decrementing Operators
$a = 0;
$a--;
--$a;
$a++;
++$a;

// Logical Operators
$a = $a && $a;
$a = $a || $a;
$a = $a ^ $b;
$longBooleanVariable = 1;
$longBoolExpression = $longBooleanVariable && $longBooleanVariable && $longBooleanVariable && $longBooleanVariable
    && $longBooleanVariable && $longBooleanVariable && $longBooleanVariable;

// Object Operator
$object = new stdClass();

echo (int) ($object->property);
echo htmlspecialchars(
    $object
        ->property
        ->veryLongNameProperty
        ->veryVeryLongNameProperty
        ->veryVeryVeryLongNameProperty
        ->veryVeryVeryVeryLongNameProperty
);

$longArgument = 1;
$longerArgument = 2;
$muchLongerArgument = 3;

$object->method();
$object->method(
    $longArgument,
    $longerArgument,
    $muchLongerArgument
);

echo htmlspecialchars($object
    ->method()
    ->veryLongNameMethod()
    ->veryVeryLongNameMethod()
    ->veryVeryVeryLongNameMethod()
    ->veryVeryVeryVeryLongNameMethod());

$object->bar(
    $longArgument,
    function ($arg2) use ($longerArgument) {
        // Nothing
    },
    $muchLongerArgument
);
$i = 'property';
$a = $object->{$i} + 1;

$notes = [
    'bar' => 'test',
    'quux' => 'test'
];
$something = 'something';
$somethingElse = 'somethingElse';
$option1 = true;
$option2 = true;

// Ternary Operator
$a = $a ? -1 : 1;
$a = $a ? 1 : -1;
$a = (\InsteriaStandardGood\Good::returnMethod()->publicMethodWithArgs($option1, $option2))
    ? $something . $notes['baz']
    : $notes['quux'] . $somethingElse;
$a = $a == 1
    ? 'Long text string. Long text string. Long text string. Long text string. Long text string. Long text string. '
        . 'Long text string. Long text string.'
    : 'Long text string. Long text string. Long text string. Long text string. Long text string. Long text string. '
        . 'Long text string. Long text string.';

// Type Operators
$var = $a instanceof stdClass;
$var = $a instanceof stdClass;

// Type Juggling
$a = (int) ($a);
$a = (int) (($a) * 2);
$a = (bool) ($a);
$a = (float) ($a);
$a = (string) ($a);
$a = (array) ($a);
$a = (object) ($a);
$a = (object) ($a);
$a = (unset) ($a);
$a = (binary) ($a);

foreach ((array) ($array) as $item) {
    echo htmlspecialchars($item);
}

if ((bool) ($a)) {
    echo (bool) ($a);
}

$a = (int) ($a) === 1 ? 1 : 2;

// Control Structures `if`
if ($a > $b) {
    echo 'a больше b';

    $b = $a;
}

// Control Structures `else`
if ($a > $b) {
    echo 'a больше, чем b';
} else {
    echo 'a НЕ больше, чем b';
}

// Control Structures `elseif`
if ($a > $b) {
    echo 'a больше, чем b';
} elseif ($a == $b) {
    echo 'a равен b';
} else {
    echo 'a меньше, чем b';
}

if (in_array(
    1,
    [
        1,
        2
    ]
)
    && $a
    && in_array(1, [1])
    || true
    && in_array(1, [
        1,
        2
    ])
    && ($b
        || $c)
) {
    echo 'test';
}

// Control Structures `while`
$i = 1;

while ($i <= 10) {
    echo (int) ($i++);
}

// Control Structures `do-while`
$i = 0;

do {
    echo (int) ($i);
} while ($i > 0);

// Control Structures `for`
for ($i = 1; $i <= 10; $i++) {
    echo (int) ($i);
}

for ($i = 1; $i <= 10; $i++) {
    if ($i > 5) {
        break;
    }

    echo (int) ($i);
}

$people = [
    [
        'name' => 'Kalle',
        'salt' => 856412
    ],
    [
        'name' => 'Pierre',
        'salt' => 215863
    ]
];

$size = count($people);

for ($i = 0; $i < $size; ++$i) {
    $people[$i]['salt'] = mt_rand(000000, 999999);
}

// Control Structures `foreach`
$array = [
    1,
    2,
    3,
    4
];

foreach ($array as &$value) {
    $value = $value * 2;
}

unset($value);

foreach ($array as $key => $value) {
    echo htmlspecialchars('Ключ: ' . $key . '; Значение: ' . $value);
}

unset($value);

$a = [];
$a[0][0] = 'a';
$a[0][1] = 'b';
$a[1][0] = 'y';
$a[1][1] = 'z';

foreach ($a as $v1) {
    foreach ($v1 as $v2) {
        echo htmlspecialchars($v2);
    }
}

$array = [
    [
        1,
        2
    ],
    [
        3,
        4
    ]
];

foreach ($array as list($a, $b)) {
    echo (int) ($a + $b);
}

// Control Structures `break`

$i = 0;

for ($i = 0; $i <= 100; $i++) {
    if ($i == 50) {
        break;
    }
}

$array = [
    1,
    2,
    3,
    4,
    5
];

foreach ($array as $index => $value) {
    if ($index == 4) {
        break;
    }

    if ($value == 3) {
        break;
    }
}

while (++$i) {
    switch ($i) {
        case 5:
            echo "Итерация 5<br />\n";
            break 1;
        case 10:
            echo "Итерация 10; выходим<br />\n";
            break 2;
        default:
            echo 'Итерация';
            break;
    }

    if ($i == 100) {
        break;
    }
}

$i = 0;

do {
    if ($i == 5) {
        break;
    }
} while ($i++);

// Control Structures `continue`
$i = 0;

while ($i++) {
    if (!($i % 2)) {
        continue;
    }

    if ($i == 100) {
        break;
    }

    echo (int) ($i);
}

$i = 0;

while ($i++ < 5) {
    echo "Снаружи<br />\n";

    while (1) {
        echo "В середине<br />\n";

        while (1) {
            echo "Внутри<br />\n";

            continue 3;
        }

        echo "Это никогда не будет выведено.<br />\n";
    }

    echo "Это тоже.<br />\n";
}

for ($i = 0; $i < 5; ++$i) {
    if ($i == 2) {
        continue;
    }

    echo (int) ($i);
}

// Control Structures `switch`
$i = 0;

switch ($i) {
    // Blank line before the case statement is allowed.
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
        // Nothing
        break;
}

$string = 'яблоко';

switch ($string) {
    case 'яблоко':
        echo 'i это яблоко';
        break;
    case 'шоколадка':
        echo 'i это шоколадка';
        break;
    case 'пирог':
        echo 'i это пирог';
        break;
    default:
        // Nothing
        break;
}

switch ($i) {
    case 0:
    case 1:
    case 2:
        echo 'i меньше чем 3, но неотрицательно';
        break;
    case 3:
        echo 'i равно 3';
        break;
    default:
        // Nothing
        break;
}

// Control Structures `declare`
declare(ticks = 1);

// Control Structures `require`, `include`, `require_once`, `include_once`
require_once 'good.php';
require 'good.php';

if ($a == true) {
    include_once 'good.php';
    include 'good.php';
}

/**
 * User-defined functions
 */
function example()
{
    echo 'example';
}

example();

range(-50, -45);

function foo($argFirst, $argSecond)
{
    echo "Example function.\n";

    $result = $argFirst + $argSecond;

    return $result;
}

$makeFoo = true;

if ($makeFoo) {
    function foo()
    {
        echo "Я не существую до тех пор, пока выполнение программы меня не достигнет.\n";
    }
}

if ($makeFoo) {
    foo();
}

// Function arguments
$array = [
    1,
    2
];

function takesArray($input)
{
    echo htmlspecialchars($input[0] . ' + ' . $input[1] . ' = ' . ($input[0] + $input[1]));

    // Blank lines after return, ignore comments
    return true;
}

takesArray($array);

function addSomeExtra(&$string)
{
    $string .= 'и кое-что еще.';
}

$str = 'Это строка, ';
addSomeExtra($str);

echo htmlspecialchars($str);

function recursion($a)
{
    if ($a < 20) {
        echo htmlspecialchars($a . "\n");

        recursion($a + 1);
    }
}

function makeCoffeeFirst($type = 'капуччино')
{
    return 'Готовим чашку ' . $type . "\n";
}

echo htmlspecialchars(makeCoffeeFirst());
echo htmlspecialchars(makeCoffeeFirst(null));
echo htmlspecialchars(makeCoffeeFirst('эспрессо'));

function makeCoffeeSecond($types = ['капуччино'], $coffeeMaker = null)
{
    $device = $coffeeMaker === null ? 'вручную' : $coffeeMaker;

    return 'Готовлю чашку ' . implode(', ', $types) . $device . "\n";
}

echo htmlspecialchars(makeCoffeeSecond());

echo htmlspecialchars(makeCoffeeSecond(
    [
        'капуччино',
        'лавацца'
    ],
    'в чайнике'
));

function makeYogurt($flavour, $type = 'ацидофил')
{
    return 'Готовим чашку из бактерий ' . $type . ' со вкусом ' . $flavour . '.' . "\n";
}

echo htmlspecialchars(makeYogurt('малины'));

function addMultipleArgument()
{
    return 'test';
}

function functionWithMultipleArguments(
    $arg,
    &$reference,
    \InsteriaStandardGood\GoodInterface $good,
    callable $callback,
    $boolean = true,
    $conts = PHP_INT_MAX,
    $integer = 1,
    $float = 1.234,
    $string = 'second',
    $null = null,
    array $array = [],
    array $arrayAnother = [
        1,
        2,
        3
    ],
    array $arrayHash = [
        'first' => 1,
        'second' => 2
    ]
) {
    // Nothing
}

function fooMultipleArguments($a, $b = null, $c = null)
{
    if ($b) {
        return $a;
    }

    if ($c) {
        return $b;
    }

    return $c;
}

$var = fooMultipleArguments($i, $i, $i);

$longNamedArgumentsWithStrangeNameAndValue = 1;

$var = fooMultipleArguments(
    $longNamedArgumentsWithStrangeNameAndValue,
    $longNamedArgumentsWithStrangeNameAndValue,
    $longNamedArgumentsWithStrangeNameAndValue
);

$var = fooMultipleArguments(
    [
        $longNamedArgumentsWithStrangeNameAndValue,
        $longNamedArgumentsWithStrangeNameAndValue,
        $longNamedArgumentsWithStrangeNameAndValue
    ]
);

// Multiline function call with array.
$var = fooMultipleArguments(
    [
        $longNamedArgumentsWithStrangeNameAndValue,
        $longNamedArgumentsWithStrangeNameAndValue,
        $longNamedArgumentsWithStrangeNameAndValue
    ],
    $longNamedArgumentsWithStrangeNameAndValue
        ? 'test'
        : 'test1',
    $longNamedArgumentsWithStrangeNameAndValue
        . 'TEXT'
);
$normalVariable = 1;
$var = fooMultipleArguments(
    function () use ($a) {
        return $a;
    },
    $longNamedArgumentsWithStrangeNameAndValue,
    $normalVariable
);

function add($a, $b)
{
    return $a + $b;
}

echo htmlspecialchars(add(
    ...[
        1,
        2
    ]
)) . "\n";

$a = [
    1,
    2
];

echo htmlspecialchars(add(...$a));

function totalIntervals($unit, DateInterval ...$intervals)
{
    $time = 0;

    foreach ($intervals as $interval) {
        $time += $interval->$unit;
    }

    return $time;
}

$a = new DateInterval('P1D');
$b = new DateInterval('P2D');

echo htmlspecialchars(totalIntervals('d', $a, $b) . ' days');

// This will fail, since null isn't a DateInterval object.
echo htmlspecialchars(totalIntervals('d', null));

function sumMultiple()
{
    $acc = 0;

    foreach (func_get_args() as $n) {
        $acc += $n;
    }

    return $acc;
}

echo (int) (sumMultiple(1, 2, 3, 4));

/**
 * Returning values
 *
 * @param $num
 * @return mixed
 */
function square($num)
{
    return $num * $num;
}

echo (int) (square(4));

function smallNumbers()
{
    return [
        0,
        1,
        2
    ];
}

list ($zero, $one, $two) = smallNumbers();

function &returnsReference()
{
    $someref = 42;

    return $someref;
}

$newref =& returnsReference();

$obj = new \InsteriaStandardGood\Good();
// $myValue reference on $obj->value, equal `42`.
$myValue = &$obj->getValue();
$obj->value = 2;

// Value is `1`
echo (float) ($myValue);

function &collectorFirst()
{
    static $collection = [];

    return $collection;
}

$collection = &collectorFirst();
$collection[] = 'foo';

function &collectorSecond()
{
    static $collection = [];

    return $collection;
}

array_push(collectorSecond(), 'foo');

function &staticReferencesFunc()
{
    static $static = 0;
    $static++;

    return $static;
}

$var1 =& staticReferencesFunc();

// Value is `1`
echo htmlspecialchars('var1:' . $var1);

staticReferencesFunc();
staticReferencesFunc();

// Value is `3`
echo htmlspecialchars('var1:' . $var1);

// assignment without the &
$var2 = staticReferencesFunc();

// Value is `4`
echo htmlspecialchars('var2:' . $var2);

staticReferencesFunc();
staticReferencesFunc();

// Value is `6`
echo htmlspecialchars('var1:' . $var1);
// Value still 4
echo htmlspecialchars('var2:' . $var2);

function sum($a, $b)
{
    return $a + $b;
}

echo (int) (sum(1, 2));

/**
 * Variable functions
 */
function fooMarkup()
{
    echo "In foo()<br />\n";
}

function bar($arg = '')
{
    echo htmlspecialchars('In bar(); argument was ' . $arg . '.<br>' . "\n");
}

/**
 * wrapper for echo
 *
 * @param $string
 */
function echoit($string)
{
    echo htmlspecialchars($string);
}

$func = 'foo';
$func();

$func = 'bar';
$func('test');

$func = 'echoit';
$func('test');

$good = new \InsteriaStandardGood\Good();
$funcname = 'emptyMethod';
$good->$funcname();

echo htmlspecialchars(\InsteriaStandardGood\Good::$basePath);

$variable = 'basePath';
\InsteriaStandardGood\Good::$variable();

/*
$funcEmptyMethod = [
    'Good',
    'emptyMethod'
];
$funcEmptyMethod();
$funcEmptyMethod2 = [
    new \InsteriaStandardGood\Good(),
    'emptyMethod'
];
$funcEmptyMethod2();
*/

$bar = '\InsteriaStandardGood\Good';
$foo = new $bar();
$foo = new $bar($i, $i);

// Anonymous functions
echo htmlspecialchars(preg_replace_callback(
    '~-([a-z])~',
    function ($match) {
        return strtoupper($match[1]);
    },
    'hello-world'
));

$greet = function ($name) {
    printf("Hello %s\r\n", htmlspecialchars($name));
};

$greet('World');
$greet('PHP');

$message = 'hello';

// Anonymous functions should not throw indentation errors here.
$test = array_walk(
    $fragments,
    function (&$item) {
        if (strpos($item, '%') === 0) {
            $item = '%';
        }
    }
);

// Without "use"
$example = function () {
    $message = new \Exception('error');

    echo htmlspecialchars($message);
};

echo htmlspecialchars($example());

$example = function () use ($message) {
    echo htmlspecialchars($message);
};

echo htmlspecialchars($example());

$message = 'world';

echo htmlspecialchars($example());

$message = 'hello';

$example = function () use (&$message) {
    echo htmlspecialchars($message);
};

echo htmlspecialchars($example());

// Измененное в родительской области видимости значение
// остается тем же внутри вызова функции
$message = 'world';

echo htmlspecialchars($example());

// Замыкания могут принимать обычные аргументы
$example = function ($arg) use ($message) {
    echo htmlspecialchars($arg . ' ' . $message);
};
$example('hello');

$longArgs_noVars = function (
    $longArgument,
    $longerArgument,
    $muchLongerArgument
) {
    // Nothing
};

$noArgs_longVars = function () use (
    $longArgument,
    $longerArgument,
    $muchLongerArgument
) {
    // Nothing
};

$longArgs_longVars = function (
    $longArgument,
    $longerArgument,
    $muchLongerArgument
) use (
    $longArgument,
    $longerArgument,
    $muchLongerArgument
) {
    // Nothing
};

$longArgs_shortVars = function (
    $longArgument,
    $longerArgument,
    $muchLongerArgument
) use ($var1) {
    // Nothing
};

$shortArgs_longVars = function ($arg) use (
    $longArgument,
    $longerArgument,
    $muchLongerArgument
) {
    // Nothing
};

/**
 * Exceptions
 *
 * @throws \Exception
 */
function doSomething()
{
    throw new \Exception('test');
}

function scream()
{
    echo '.......';
}

try {
    doSomething();
} catch (ErrorException $e) {
    scream();
} catch (OutOfRangeException $e) {
    echo 'Bad';
} finally {
    echo 'Final';
}

// Security issue: http://drupal.org/node/750148
preg_match('/.+/i', 'subject');
preg_match('/.+/imsuxADSUXJ', 'subject');
preg_filter('/.+/i', 'replacement', 'subject');
preg_replace('/.+/i', 'replacement', 'subject');

// Use a not so common delimiter.
preg_match('@.+@i', 'subject');
preg_match('@.+@imsuxADSUXJ', 'subject');
preg_filter('@.+@i', 'replacement', 'subject');
preg_replace('@.+@i', 'replacement', 'subject');
preg_match('/test(\d+)/is', 'subject');

// Comments
echo 'Text';

// Это однострочный комментарий в стиле c++
/*
    Это многострочный комментарий
    еще одна строка комментария
*/
echo 'More text';

// Global keyword
global $argc, $argv, $user, $is_https, $_mymodule_myvar;

$a = 1;
// SQL

// Exit
exit();
