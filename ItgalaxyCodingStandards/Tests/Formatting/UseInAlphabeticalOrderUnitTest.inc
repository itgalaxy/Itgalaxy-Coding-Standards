<?php
namespace Foo;

use ArrayObject;
use Bar\BarClass;
use A\AClass;

use ArrayObject, Bar\BarClass;

$string = 'Hello world';
$someFunction = function () use ($string) {
    return $string;
};

class Base
{
    public function sayHello() {
        echo 'Hello ';
    }
}

trait ASayWorld
{
    public function sayHello() {
        parent::sayHello();
        echo 'World!';
    }
}

trait BSayWorld
{
    public function sayHello() {
        parent::sayHello();
        echo 'World!';
    }
}

class MyHelloWorldFirst extends Base
{
    use ASayWorld;
    use BSayWorld;
}

class MyHelloWorldSecond extends Base
{
    use BSayWorld;
    use ASayWorld;
}
