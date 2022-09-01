<?php
session_start();

require_once '../../../vendor/autoload.php';

$results = [];

foreach ($_SESSION['text_statistic']['results'] as $record) {
    $results[] = json_decode($record, true);
}

$count = min($_GET['count'] ?? 10, count($results));

for ($i=0; $i < $count; $i++) {
    echo '<table>';
    foreach ($results[$i] as $key=>$value) {
        echo '<tr>';
        echo '<td>' . $key . '</td>';
        echo '<td>' . (is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : $value) . '</td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '<hr/>';
}
?>
<!doctype html>
<html>
<head>
    <title>PHP Advanced</title>
    <style>
        table, th, td {
            border:1px solid black;
        }
    </style>
</head>
</html>
