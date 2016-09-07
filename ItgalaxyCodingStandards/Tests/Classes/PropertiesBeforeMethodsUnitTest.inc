<?php

class Test
{
    public $public = 'public';

    protected $protected = 'protected';

    private $private = 'private';

    public function publicFunction()
    {
        return $this->protectedFunction() . $this->privateFunction() . $this->public;
    }

    protected function protectedFunction()
    {
        return $this->protected;
    }

    private function privateFunction()
    {
        return $this->private;
    }
}

class TestError1
{
    public function publicFunction()
    {
        return $this->protectedFunction() . $this->privateFunction() . $this->public;
    }

    public $public = 'public';

    protected function protectedFunction()
    {
        return $this->protected;
    }

    protected $protected = 'protected';

    private function privateFunction()
    {
        return $this->private;
    }

    private $private = 'private';
}

class TestError2
{
    public $public = 'public';

    public function publicFunction()
    {
        return $this->protectedFunction() . $this->privateFunction() . $this->public;
    }

    protected $protected = 'protected';

    protected function protectedFunction()
    {
        return $this->protected;
    }

    private $private = 'private';

    private function privateFunction()
    {
        return $this->private;
    }
}

class TestError3
{
    protected $protected = 'protected';

    protected function protectedFunction()
    {
        return $this->protected;
    }
    private $private = 'private';

    public function publicFunction()
    {
        return $this->protectedFunction() . $this->privateFunction() . $this->public;
    }

    public $public = 'public';

    private function privateFunction()
    {
        return $this->private;
    }
}
