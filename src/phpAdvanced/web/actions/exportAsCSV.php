<?php

require_once '../../../../vendor/autoload.php';

$file = 'result.csv';

header('Content-Type: application/force-download');
header('Content-Type: application/octet-stream');
header('Content-Type: application/download');

header("Content-Disposition: attachment;filename={$file}");
header('Content-Transfer-Encoding: binary');

$data = json_decode($_POST['data'], true);

foreach ($data as $key => $value) {
    $data[$key] = is_array($value)
        ? json_encode($value)
        : $value;
}

ob_start();

$file = fopen("php://output", 'w');

fputcsv($file, array_keys($data));

fputcsv($file, $data);

fclose($file);

echo ob_get_clean();
