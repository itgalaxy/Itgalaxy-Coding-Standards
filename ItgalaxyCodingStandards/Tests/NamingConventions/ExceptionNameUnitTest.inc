<?php

class MyException extends Exception
{
    public $property = false;

    public function __construct($message, $code = 0, Exception $previous = null)
    {
        $this->property = true;

        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . '": [' . $this->code . '}]: ' . $this->message . "\n";
    }

    public function customFunction()
    {
        echo "Custom Function\n";
    }
}

class ExceptionMy extends Exception
{
    public $property = false;

    public function __construct($message, $code = 0, Exception $previous = null)
    {
        $this->property = true;

        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . '": [' . $this->code . '}]: ' . $this->message . "\n";
    }

    public function customFunction()
    {
        echo "Custom Function\n";
    }
}

class StrangeName extends Exception
{
    public $property = false;

    public function __construct($message, $code = 0, Exception $previous = null)
    {
        $this->property = true;

        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . '": [' . $this->code . '}]: ' . $this->message . "\n";
    }

    public function customFunction()
    {
        echo "Custom Function\n";
    }
}
