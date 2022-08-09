<?php

require_once __DIR__ . './../../../config/bootstrap.php';

use http_part_2\Controllers\FavouritesController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();

try {
    $favourite = (new FavouritesController($entityManager))->getFavourite($request->get('id'));

    $response = json_encode($favourite->toArray(), JSON_PRETTY_PRINT);
} catch (Throwable) {
    $response = new Response('Item not exist anymore', 404);
}
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
    <pre><?= $response ?></pre>
</main>
</html>
