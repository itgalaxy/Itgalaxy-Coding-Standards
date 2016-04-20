<?php
Base::staticFunction()['test'] = 1;
?>
<?php
$a = $b = 1;
$a
    = $b
    = 1;

if (($a = $b) !== null) {
    $a = 1;
}

while (($a = $b) != null) {
    $a = 2;
}

$start = 0;
$count = 0;

while (($pos = strpos('test', 't', $start)) !== false) {
    $start = $pos + 1;
    $count++;
}

for ($a = 1, $b = 1; $a < $b; $a++) {
    $a = $b + 1;
}

$var = 'test';
$obj->$var = $var;
$obj->$$var = $var;

$test = $var = $var ? 1 : 2;
$test = $var ? $a = $b : $b = $a;

function test($a = 1)
{
    $b = $a;

    return $b;
}

$closure = function ($a = 1) {
    $b = $a;

    return $b;
};

$test = $var;

$callableFunction = 'strpos';
$val = $callableFunction($string = 'test', 't');

if ($a = $b) {
    $output = 'Bad example for test';
}

class Base extends Exception
{
    public static $static = 'static';

    public $lastFunction = null;

    public static function staticFunction()
    {
        return [
            'test' => 'test'
        ];
    }

    public function test()
    {
        $function = 'getMessage';
        self::$lastFunction = $function;

        return self::$function();
    }
}

// Todo must throw error
Base::$static = 'Nothing' = 'Nothing2';

Base::staticFunction()['test'] = 1;
$array = [
    'test' => ['value']
];

$index = 'test';
$val = $array[$index]['value'];
$val = $array[$index = 'test']['value'];

// Bad example for test
$val = $array{$index}{'value'};

$val = $array{'test'} = '123';

$jsonIndex = 'test';
$val = json_decode('{"test": {"test":"test"}}', true)[$jsonIndex];

$value = true;
$newValue = null;
$someFunction = 'json_decode';
$val = $someFunction('{"test": "test"}', true)['test'] = 1 ? $newValue = 1 : $newValue = 2;
