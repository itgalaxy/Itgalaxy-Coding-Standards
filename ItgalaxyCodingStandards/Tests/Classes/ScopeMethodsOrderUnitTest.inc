<?php

class Test
{
    public function publicFunction()
    {
        return $this->protectedFunction() . $this->privateFunction() . $this->publicVariable;
    }

    protected function protectedFunction()
    {
        return $this->protectedVariable;
    }

    private function privateFunction()
    {
        return $this->privateVariable;
    }
}

class ErrorTest1
{
    public function publicFunction()
    {
        return $this->protectedFunction() . $this->privateFunction() . $this->publicVariable;
    }

    private function privateFunction()
    {
        return $this->privateVariable;
    }

    protected function protectedFunction()
    {
        return $this->protectedVariable;
    }
}

class ErrorTest2
{
    protected function protectedFunction()
    {
        return $this->protectedVariable;
    }

    public function publicFunction()
    {
        return $this->protectedFunction() . $this->privateFunction() . $this->publicVariable;
    }

    private function privateFunction()
    {
        return $this->privateVariable;
    }
}

class ErrorTest3
{
    protected function protectedFunction()
    {
        return $this->protectedVariable;
    }

    private function privateFunction()
    {
        return $this->privateVariable;
    }

    public function publicFunction()
    {
        return $this->protectedFunction() . $this->privateFunction() . $this->publicVariable;
    }
}

class ErrorTest4
{

    private function privateFunction()
    {
        return $this->privateVariable;
    }

    protected function protectedFunction()
    {
        return $this->protectedVarialbe;
    }

    public function publicFunction()
    {
        return $this->protectedFunction() . $this->privateFunction() . $this->publicVariable;
    }
}

class ErrorTest5
{

    private function privateFunction()
    {
        return $this->privateVarialbe;
    }

    public function publicFunction()
    {
        return $this->protectedFunction() . $this->privateFunction() . $this->publicVariable;
    }

    protected function protectedFunction()
    {
        return $this->protectedVariable;
    }
}

interface FooInterface
{
    public function publicFunction();
}

trait FooTrait
{
    public function publicFunction()
    {
        return $this->protectedFunction() . $this->privateFunction() . $this->publicVariable;
    }

    protected function protectedFunction()
    {
        return $this->protectedVariable;
    }

    private function privateFunction()
    {
        return $this->privateVariable;
    }
}

class FooBar1
{
    public $foobar;
    protected $bar;
    private $foo;
}

class FooBar2
{
    private $foo;
    protected $bar;
    public $foobar;
}

class FooBar3
{
    private $foo;
    public $foobar;
    protected $bar;
}

class FooBar4
{
    public $foobar;
    private $foo;
    protected $bar;
}

class FooBar4
{
    public $foobar;

    protected $bar;

    private $foo;

    public function publicFunction()
    {
        return $this->protectedFunction() . $this->privateFunction() . $this->publicVariable;
    }

    protected function protectedFunction()
    {
        return $this->protectedVariable;
    }

    private function privateFunction()
    {
        return $this->privateVariable;
    }
}
