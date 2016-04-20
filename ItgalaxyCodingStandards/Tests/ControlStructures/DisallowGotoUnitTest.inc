<?php
goto a;
echo 'Foo';

a:
echo 'Bar';
?>
<?php
for ($i = 0; $i < 100; $i++) {
    if ($i == 17) {
        goto end;
    }
}

echo "i = $i";
end:
echo 'j hit 17';
?>
