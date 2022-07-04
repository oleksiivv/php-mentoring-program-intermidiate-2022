<?php

require_once '../TextStatisticsController.php';

use src\phpBasics\TextStatisticsController;

if (isset($_POST['submit'])) {
    $textStatisticsController = new TextStatisticsController();
    $textStatisticsController->setText($_POST['text']);

    $result = $textStatisticsController->processText();

    echo '<table>';
    foreach ($result as $key=>$value) {
        echo '<tr>';
        echo '<td>' . $key . '</td>';
        echo '<td>' . (is_array($value) ? json_encode($value, JSON_PRETTY_PRINT) : $value) . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}
?>
<!doctype html>
<html>
<head>
    <title>PHP Basics</title>
    <style>
        table, th, td {
            border:1px solid black;
        }
    </style>
</head>
<body>

<form method="POST" action="">
    <h3>Process Text</h3>
    <textarea name="text" placeholder="Text:"></textarea>
    <br/>
    <input name="submit" type="submit" value="Submit"/>
</form>

</body>
</html>