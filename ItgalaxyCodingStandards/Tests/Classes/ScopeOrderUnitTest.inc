<?php

class Test
{
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

class ErrorTest1
{
    public function publicFunction()
    {
        return $this->protectedFunction() . $this->privateFunction() . $this->public;
    }

    private function privateFunction()
    {
        return $this->private;
    }

    protected function protectedFunction()
    {
        return $this->protected;
    }
}

class ErrorTest2
{
    protected function protectedFunction()
    {
        return $this->protected;
    }

    public function publicFunction()
    {
        return $this->protectedFunction() . $this->privateFunction() . $this->public;
    }

    private function privateFunction()
    {
        return $this->private;
    }
}

class ErrorTest3
{
    protected function protectedFunction()
    {
        return $this->protected;
    }

    private function privateFunction()
    {
        return $this->private;
    }

    public function publicFunction()
    {
        return $this->protectedFunction() . $this->privateFunction() . $this->public;
    }
}

class ErrorTest4
{

    private function privateFunction()
    {
        return $this->private;
    }

    protected function protectedFunction()
    {
        return $this->protected;
    }

    public function publicFunction()
    {
        return $this->protectedFunction() . $this->privateFunction() . $this->public;
    }
}

class ErrorTest5
{

    private function privateFunction()
    {
        return $this->private;
    }

    public function publicFunction()
    {
        return $this->protectedFunction() . $this->privateFunction() . $this->public;
    }

    protected function protectedFunction()
    {
        return $this->protected;
    }
}
