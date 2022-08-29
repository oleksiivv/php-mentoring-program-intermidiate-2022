<?php

require_once '../../../../vendor/autoload.php';

$file = "result.xls";

header('Content-Type: application/force-download');
header('Content-Type: application/octet-stream');
header('Content-Type: application/download');

header("Content-Disposition: attachment; filename=\"$file\"");
header("Content-Type: application/vnd.ms-excel");

$data = json_decode($_POST['data'], true);

$values = array_map(function ($item) {
    return is_array($item)
        ? json_encode($item)
        : $item;
}, array_values($data));

echo implode("\t", array_keys($data)) . "\n";

echo implode("\t", $values) . "\n";
