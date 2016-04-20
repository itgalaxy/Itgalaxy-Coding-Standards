<?php
$string = "$variable";
$string = "{$variable}";
$string = "{{$variable}";
$string = "{$variable}}";
$string = "{{$variable}}";
$string = "
$variable
";
$string = "

$variable
";
$string = "
$variable

";
$string = "

$variable

";
$string = "$variableFirst_$variableSecond";
$string = "$variableFirst_{$variableSecond}";
$string = "{$variableFirst}_$variableSecond";
$string = "{$variableFirst}_{$variableSecond}";
someFunction("{$args['rewrite']['slug']}/%$taxonomy%");
