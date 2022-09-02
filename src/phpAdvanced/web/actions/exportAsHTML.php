<?php

require_once '../../../../vendor/autoload.php';

$file = 'result.html';

header('Content-Type: application/force-download');
header('Content-Type: application/octet-stream');
header('Content-Type: application/download');

header("Content-Disposition: attachment;filename={$file}");
header('Content-Transfer-Encoding: binary');

echo $_POST['data'];
