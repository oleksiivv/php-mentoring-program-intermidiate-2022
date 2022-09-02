<?php

session_start();

use phpAdvanced\Entities\StatisticRecord;
use phpAdvanced\Repositories\TextStatisticsRepository;
use phpAdvanced\Services\AverageCalculationService;

require_once '../../../vendor/autoload.php';
require_once __DIR__ . './../../../config/bootstrap.php';

$repository = new TextStatisticsRepository($entityManager);

if (isset($_GET['search-by-date'])) {
    $records = $repository->getAllInDateRange(session_id(), $_GET['from'], $_GET['to']);
} else {
    $records = $repository->getAll(session_id());
}

$statsFromRecords = array_map(function (StatisticRecord $record) {
    return $record->getStatistic();
}, $records);

$averageData = AverageCalculationService::perform($statsFromRecords);

echo '<table>';
foreach ($averageData as $key => $value) {
    echo '<tr>';
    echo '<td>' . $key . '</td>';
    echo '<td>' . (is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : $value) . '</td>';
    echo '</tr>';
}
echo '</table>';
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
<body>
<form method="GET" action="">
    <input type="text" name="from" placeholder="From: " required><br/>
    <input type="text" name="to" placeholder="To:" required><br/>
    <input type="submit" name="search-by-date" value="Search"/>
</form>
</body>
</html>
