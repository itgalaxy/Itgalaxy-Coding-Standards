<?php
namespace InsteriaStandardGood;

require_once 'AbstractGood.php';
require_once 'GoodInterface.php';

class Good extends AbstractGood implements
    GoodInterface,
    \Serializable
{
    const INFO = 0;

    const WARNING = 1;

    const ERROR = 2;

    const EMERGENCY = 3;

    /**
     * Private properties have no prefix.
     */
    private $secret = 1;

    /**
     * Protected properties also don't have a prefix.
     */
    protected $foo = 1;

    /**
     * Longer properties use camelCase naming.
     */
    public $barProperty = 1;

    public $value = 42;

    /**
     * Public static variables use camelCase, too.
     */
    public static $basePath = null;

    /**
     * Enter description here ...
     */
    public function foo($name, $var, $string)
    {
        // test
        if ($string == 'test') {
            echo (int) ($string);
        }
        // test
    }
    // test

    public function test($test)
    {
        echo 'test';
    }

    /**
     * Empty method implementation is allowed.
     */
    public function emptyMethod()
    {
        echo 'empty';
    }

    public static function returnMethod()
    {
        return new Good();
    }

    public function publicMethodWithArgs($arg1, $arg2)
    {
        return $arg1 || $arg2;
    }

    public function &getValue()
    {
        return $this->value;
    }

    public function serialize()
    {
        // Nothing
    }

    public function unserialize($string)
    {
        // Nothing
    }

    public function aVeryLongMethodName(
        GoodInterface $arg1,
        &$arg2,
        array $arg3 = []
    ) {
        // Nothing
    }

    public function startEl($text = false)
    {
        echo htmlspecialchars($text);
    }

    /**
     * Enter description here ...
     */
    protected function barMethod()
    {
        return $this->secret;
    }

    /**
     * Protected functions are allowed.
     */
    protected function protectedTest()
    {
        echo 'protected';
    }
}
