<?php

require_once __DIR__ . './../../../config/bootstrap.php';

use http_part_2\Repositories\DB\SettingsRepository;
use http_part_2\Services\HttpService;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$settings = (new SettingsRepository($entityManager))->getByUser(HttpService::X_API_KEY);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Cats</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<main role="main" class="container">

    <br/>
    <a href="favourites.php" class="btn btn-outline-primary">Favourites</a>
    <a href="breeds.php" class="btn btn-outline-primary">All breeds</a>
    <a href="settings.php" class="btn btn-outline-primary">Settings</a>
    <br/><br/><br/>

    <h3>Settings</h3>
    <br/>
    <form action="../Actions/updateSettings.php" method="POST">
        Logging: <input name="logging" type="checkbox" value="<?= $settings->isLogging() ? 1 : 0 ?>"/><br/>
        Offline: <input name="offline" type="checkbox" value="<?= $settings->isOfflineMode() ? 1 : 0 ?>"/><br/>
        Response caching: <input name="caching" type="checkbox" value="<?= $settings->isResponseCaching() ? 1 : 0 ?>"/><br/>

        <input type="submit" name="update-settings" class="btn btn-primary" value="Update"/>
    </form>
</main>
</html>