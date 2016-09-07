<?php
$i = 0;
do {
    echo $i;
} while ($i > 0);

do
{
    echo $i;
} while ($i > 0);

do
{
    echo $i;
}
while ($i > 0);

do { echo $i; } while ($i > 0);

do{
    echo $i;
}while($i > 0);

while ($i < 1) {
    echo $i;
}

while($i < 1){
    echo $i;
}

while ($i < 1) { echo $i; }

for ($i = 1; $i < 1; $i++) {
    echo $i;
}

for($i = 1; $i < 1; $i++){
    echo $i;
}

for ($i = 1; $i < 1; $i++) { echo $i; }

if ($i == 0) {
    $i = 1;
}

if($i == 0){
    $i = 1;
}

if ($i == 0) { $i = 1; }

if ($i == 0) {
    $i = 1;
} else {
    $i = 0;
}

if ($i == 0) {
    $i = 1;
}else{
    $i = 0;
}

if ($i == 0) { $i = 1; } else { $i = 0; }

if ($i == 0) {
    $i = 1;
} else if ($i == 2) {
    $i = 0;
}

if ($i == 0) {
    $i = 1;
}else   if($i == 2){
    $i = 0;
}

if ($i == 0) { $i = 1; } else if ($i == 2) { $i = 0; }

if ($i == 0) { // comments are allowed
    $i = 1;
}

if ($i == 0) {// comments are allowed
    $i = 1;
}

if ($i == 0) { /* comments are allowed*/
    $i = 1;
}

if ($i == 0)
{ // this is ok
    $i = 1;
}

if ($i == 0) /* this is ok */ {
}

try {
    $code = 'this';
} catch (Exception $e) {
    // Caught!
}

try { $code = 'this'; } catch (Exception $e) {
    // Caught!
}

do { echo $i;
} while ($i > 0);

if ($i === 0) {

    $i = 1;
}

if ($a) {

}
elseif ($b) {
}

foreach ($items as $item) {
    echo $item;
}

foreach($items as $item){
    echo $item;
}

if ($a && $b) // && $c)
{
}

if ($a == 5) :
    echo "a equals 5";
    echo "...";
elseif ($a == 6) :
    echo "a equals 6";
    echo "!!!";
else :
    echo "a is neither 5 nor 6";
endif;

try {
    // try body
}
catch (FirstExceptionType $e) {
    // catch body
}
catch (OtherExceptionType $e) {
    // catch body
}

switch($foo) {

    case 'bar':
        break;

}

if ($foo)  :
endif;

?>

<?php while($row = $data->getRow()): ?>
    <p><?= $val ?></p>
<?php endwhile; ?>

<?php
if ($foo === 1) {
    ?>
    <table><tr><td>
                <?php
                echo '2';
                ?>
            </td></tr></table>
    <?php
}

?>
<?php foreach($formset['Fieldset'] as $fieldset): ?>
    <?php foreach($fieldset['Field'] as $field): ?>
    <?php endforeach; ?>
<?php endforeach; ?>

<?php foreach ($formset['Fieldset'] as $fieldset) : ?> hello
<?php endforeach; ?>

<?php foreach ($formset['Fieldset'] as $fieldset) :
    ?>
    hello
<?php endforeach; ?>
<?php

// Comment
if ($condition) {
    $a = 1;
}

// Comment
// Comment
if ($condition) {
    $a = 1;
}

// Comment
if ($condition) {
    $a = 1;
}
// Comment

if ($condition) {
    $a = 1;
}
// Comment
// Comment

if ($condition) {
    $a = 1;
}
// Comment
$b = 1;

if ($condition) {
    $a = 1;
}
$b = 1;

if ($condition) {
    $a = 1;
}  // test

$i = 0;

do
    echo $i;
while ($i > 0);

$a = 1;

if ($a == 1) {
    echo 'test';
}
// Comment
// Comment

if ($condition) {
    $a = 1;
} /* Comment */ else {
    $b = 2;
}

if ($condition) {
    $a = 1;
}  /* Comment */  else {
    $b = 2;
}

if ($condition) {
    $a = 1;
} else /* Comment */ {
    $b = 2;
}

if ($condition) {
    $a = 1;
} else  /* Comment */  {
    $b = 2;
}

if ($condition) {
    $a = 1;
} /* Comment */ else /* Comment */ {
    $b = 2;
}

if ($condition) {
    $a = 1;
}  /* Comment */  else  /* Comment */  {
    $b = 2;
}

if ($condition1) {
    $a = 1;
} /* Comment */ else if ($condition2) /* Comment */ {
    $b = 2;
}

if ($condition1) {
    $a = 1;
} /* Comment */ elseif ($condition2) /* Comment */ {
    $b = 2;
}

try {
    someFunction();
} /* Comment */ catch (Exception $e) /* Comment */ {
    print_r($e);
}

try {
    someFunction();
} catch /* Comment */ (Exception $e) {
    print_r($e);
}

try {
    someFunction();
} catch (Exception $e) {
    print_r($e);
} /* Comment */ finally /* Comment */ {
    anotherFunction();
}

while ($i <= 10) {
    echo $i++;
}

do {
    echo $i;
} while ($i > 0) ;

do {
    echo $i;
} while ($i > 0)
;

do {
    echo $i;
}     while ($i > 0);

if(true){}else{}

while(true) ?>
<?php while(true)
    echo 'test';

if ( true ){echo 'test';}
else {

}

if (
    true
)
{echo 'test';}
else {

}?>
<?php

if(
true
) {
    echo 'test';
}
