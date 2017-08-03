<?php
$color = 'red';;

$color = 'red';
;

for ($i = 1; $i < 10; $i++) {
    echo $i;
}

for ($i = 1; $i < 10; $i++) {
    echo $i;;
}

for (
    $i = 1;
    $i < 10;
    $i++
) {
    echo $i;
}

for ($i = 1; $i < 10; $i++) echo 'test';

for ($i = 1; ; $i++) {

}

$y = 2;;
echo $y;
for ($i = 1; $i < $length; $i++) {}
for (; $i < $length; $i++) {}
echo 'x'; echo $y;
$x = 10; echo $y;
$this->wizardid = 10; $this->paint(); echo 'x';
?>
<div class="<?php echo $class; ?>" id="<?php echo $id; ?>"></div>
<div class="<?php echo $class ?>" id="<?php echo $id ?>"></div>
<div class="<?= $class; ?>" id="<?= $id; ?>"></div>
<div class="<?= $class ?>" id="<?= $id ?>"></div>
<?php
$foo = 1;/* Comment */;
$bar = 1;
/*
 * Test
 */
;

$foo = function () {
    echo 'bar';
};
$fooBar = barFooBar(function () {
    return 'test';
});
$fooBar = barFooFoo(function () { return 'test'; });
