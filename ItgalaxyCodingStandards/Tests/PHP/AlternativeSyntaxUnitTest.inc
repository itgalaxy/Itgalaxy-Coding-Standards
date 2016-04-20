<?php
$foo = 5;
?>

<?php
declare(ticks = 0) :
    echo "Statement 1\n";
    echo "Statement 2\n";
enddeclare;
?>

<?php
for ($i = 1; $i <= 4; ++$i) :
    echo "$i\t";
    echo ($i * $i)."\n";
endfor;
?>

<?php for ($i = 1; $i <= 10; ++$i) : ?>
    <?php echo "$i\t"; ?>
    <?= ($i * $i)."\n"; ?>
<?php endfor; ?>

<?php
foreach (['a', 'b'] as $val) :
    echo $val;
    echo "\n";
endforeach;
?>

<?php foreach ([1,2, 3] as $item): ?>
    <li>
        <?=$item?>
    </li>
<?php endforeach; ?>

<?php
if ($a == 5):
    echo "a равно 5";
    echo "...";
elseif ($a == 6):
    echo "a равно 6";
    echo "!!!";
else:
    echo "a не равно ни 5 ни 6";
endif;
?>

<?php if ($username == 'sally'): ?>
    <h3>Hi Sally</h3>
<?php elseif ($username == 'joe'): ?>
    <h3>Hi Joe</h3>
<?php else: ?>
    <h3>Hi unknown user</h3>
<?php endif; ?>

<?php
switch (true):
endswitch;
?>

<?php
switch (10) :
case 10 :
echo "case 10\n";
break;
case 20 :
echo "case 20\n";
break;
default :
echo "default case";
break;
endswitch;
?>

<?php switch($variable): ?>
<?php case 1: ?>
    <div>
        Newspage
    </div>
    <?php break;?>
<?php case 2: ?>
    </div>
    Forum
    <div>
<?php break;?>
<?php endswitch;?>

<?php
$i = 1;
while ($i <= 10):
    echo $i;
    $i++;
endwhile;
?>

<?php $i = 1; ?>
<?php while ($i <= 10): ?>
    <?php
    echo $i;
    $i++;
    ?>
<?php endwhile; ?>
