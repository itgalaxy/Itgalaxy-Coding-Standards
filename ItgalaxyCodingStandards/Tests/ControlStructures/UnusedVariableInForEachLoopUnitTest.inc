<?php
$array = [
    'val1' => 1,
    'val2' => 2,
    'val3' => 3
];
$output = '';

foreach ($array as $index => $val) {
    $output .= $index . $val;
}

foreach ($array as $index => $val) {
    $output .= $index;
}

foreach ($array as $index => $_) {
    $output .= $index;
}

foreach ($array as $index => $_) {
    $output .= $index . $_;
}

foreach ($array as $index => $val) {
    $output .= $val;
}
?>
<?php foreach ($array as $index => $val) : ?>
    <?php $output .= $index . $val; ?>
<?php endforeach; ?>
<?php foreach ($array as $index => $val) : ?>
    <?php $output .= $index; ?>
<?php endforeach; ?>
<?php foreach ($array as $index => $_) : ?>
    <?php $output .= $index; ?>
<?php endforeach; ?>
<?php foreach ($array as $index => $_) : ?>
    <?php $output .= $index . $_; ?>
<?php endforeach; ?>
<?php foreach ($array as $index => $val) : ?>
    <?php $output .= $val; ?>
<?php endforeach; ?>
<?php
foreach ($array as $index => $val)
    $output .= $index . $val;

foreach ($array as $index => $val)
    $output .= $index;

foreach ($array as $index => $_)
    $output .= $index;

foreach ($array as $index => $_)
    $output .= $index . $_;

foreach ($array as $index => $val)
    $output .= $val;

$result = 0;

foreach ($array as $value) {
    $result = $value * 2;
}

foreach ($array as $value) {
    $result = 2 * 2;
}

foreach ($array as $_) {
    $result = 2 * 2;
}

foreach ($array as $_) {
    $result = $_ * 2;
}
?>
<?php foreach ($array as $value) : ?>
    <?php $result = $value * 2; ?>
<?php endforeach; ?>
<?php foreach ($array as $value) : ?>
    <?php $result = 2 * 2; ?>
<?php endforeach; ?>
<?php foreach ($array as $_) : ?>
    <?php $result = 2 * 2; ?>
<?php endforeach; ?>
<?php foreach ($array as $_) : ?>
    <?php $result = $_ * 2; ?>
<?php endforeach; ?>
<?php
foreach ($array as $value)
    $result = $value * 2;

foreach ($array as $value)
    $result = 2 * 2;

foreach ($array as $_)
    $result = 2 * 2;

foreach ($array as $_)
    $result = $_ * 2;

foreach ($objects['objects'] as $object) {
    $line = "{$object}";
}

foreach ($array as $index => $val) {
    $output .= "{$index}_{$val}";
}

foreach ($array as $index => $val) {
    $output .= "{$index}_index";
}

foreach ($array as $index => $val) {
    $output .= "{$val}_val";
}

foreach ($array as $index => $val) {
    $output .= "$index $val";
}

foreach ($array as $index => $val) {
    $output .= "\$index \$val";
}
