<?php
namespace InsteriaStandardGood;

require_once 'Good.php';

class SuperGood extends Good
{
    public function startEl($test)
    {
        parent::startEl($test);

        echo 'test';
    }
}
