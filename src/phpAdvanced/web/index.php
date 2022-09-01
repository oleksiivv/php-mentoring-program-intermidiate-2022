<?php
session_start();

require_once '../../../vendor/autoload.php';
require_once __DIR__ . './../../../config/bootstrap.php';

use phpAdvanced\Services\TextStatisticsService;
use phpAdvanced\Repositories\TextStatisticsRepository;

if (isset($_POST['submit'])) {
    $text = $_POST['text'] ?? null;

    $file = $_FILES['file']['tmp_name'] ?? null;

    if ($file) {
        $text = htmlspecialchars(file_get_contents($file));
    } elseif ($_POST['url']) {
        $text = htmlspecialchars(file_get_contents($_POST['url']));
    }

    $textStatisticsService = new TextStatisticsService();

    $textStatisticsService->setTextStatisticsRepository(new TextStatisticsRepository($entityManager));
    $textStatisticsService->setText($text);

    $result = $textStatisticsService->processText(session_id());

    $_SESSION['text_statistic']['results'][$text] = json_encode($result);

    echo '<table>';
    foreach ($result as $key=>$value) {
        echo '<tr>';
        echo '<td>' . $key . '</td>';
        echo '<td>' . (is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : $value) . '</td>';
        echo '</tr>';
    }
    echo '</table>';
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
<body>

<a href="stats.php?count=10"><h1>Stats from session</h1></a>
<a href="global_stats.php"><h1>Stats from db</h1></a>

<form method="POST" action="" enctype="multipart/form-data">
    <h3>Process Text</h3>
    <textarea name="text" placeholder="Text:"></textarea><br/><br/>
    Or<br/>
    <input type="file" accept=".xml,.html,.txt" name="file"><br/>
    Or<br/>
    <input type="url" name="url" placeholder="https://example.com"><br/>
    <br/>
    <input name="submit" type="submit" value="Submit"/>
</form>

<?php
    if (isset($result)):
        ?>
        <form action="actions/exportAsXLS.php" method="POST">
            <input type="hidden" name="data" value="<?=htmlspecialchars(json_encode($result))?>">
            <input type="submit" name="export" value="Export as XLS"/>
        </form>

        <form action="actions/exportAsCSV.php" method="POST">
            <input type="hidden" name="data" value="<?=htmlspecialchars(json_encode($result))?>">
            <input type="submit" name="export" value="Export as CSV"/>
        </form>

        <form action="actions/exportAsHTML.php" method="POST">
            <input type="hidden" name="data" value="<?=htmlspecialchars(json_encode($result))?>">
            <input type="submit" name="export" value="Export as HTML"/>
        </form>
<?php endif; ?>

</body>
</html>