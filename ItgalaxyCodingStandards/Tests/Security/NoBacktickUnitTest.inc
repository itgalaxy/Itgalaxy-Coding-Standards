<?php

class TestBacktick
{
    public function go()
    {
        $error = `ls -l`;
        $notError = '`ls -l`';
    }
}

$error = `ls`;
$notError = '`ls`';
