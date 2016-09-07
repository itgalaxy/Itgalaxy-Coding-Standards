<?php

class Base
{
    public function name($str = 'Test')
    {
        return strtolower($str);
    }

    public function nickname($str = 'Test')
    {
        return strtoupper($str);
    }
}

class ExtenderBase extends Base
{
    public function name($str = 'Test')
    {
        return trim(parent::name($str));
    }
}

class ErrorExtenderBase extends Base
{
    public function name($str = 'Test')
    {
        return trim(parent::nickname($str));
    }
}

class PropertiesExtenderBase extends Base
{
    public function name($str = 'Test')
    {
        return trim(parent::$static);
    }
}

class PropertiesExExtenderBase extends Base
{
    public function name($str = 'Test')
    {
        $func = function () {
            parent::nickname();
        };

        return $func;
    }
}
