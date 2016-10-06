<?php

abstract class AbstractClass
{
    public function returnOut()
    {
        return $this->getValue() . "\n";
    }

    abstract protected function getValue();
    abstract protected function prefixValue($prefix);
}

abstract class ClassAbstract
{
    public function returnOut()
    {
        return $this->getValue() . "\n";
    }

    abstract protected function getValue();
    abstract protected function prefixValue($prefix);
}

abstract class StrangeName
{
    public function returnOut()
    {
        return $this->getValue() . "\n";
    }

    abstract protected function getValue();
    abstract protected function prefixValue($prefix);
}
