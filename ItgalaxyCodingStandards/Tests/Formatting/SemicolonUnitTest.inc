<?php $foo = 1 ?>
<?php $foo = 1; ?>
<?php
if ($foo == 1) {
    $foo = 2;
}
?>
<?php
if ($foo == 2)
    $foo = 3;
?>
<?php
if ($foo == 2) :
    $foo = 3;
endif;
?>
<?php if ($foo == 3) { ?>
    <?php $foo = 4; ?>
<?php } ?>
<?php ?>
<?php if ($foo == 3) : ?>
    <?php $foo = 4; ?>
<?php endif; ?>
<?php
