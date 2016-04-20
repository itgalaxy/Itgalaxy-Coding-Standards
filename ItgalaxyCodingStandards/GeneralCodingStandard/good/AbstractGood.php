<?php
namespace Insteria;

abstract class AbstractGood
{
    abstract public function test($test);

    public function test2($test)
    {
        echo htmlspecialchars($test);
    }
}
