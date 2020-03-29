<?php

$prefix = '+34794';
$fp = fopen('file.csv', 'w+');
fputcsv($fp, ['phone']);
for($i = 0; $i <= 999999; $i++)
{
    $number = $prefix . str_pad($i, 6, STR_PAD_LEFT);
    fputcsv($fp, [$number]);
}
fclose($fp);
