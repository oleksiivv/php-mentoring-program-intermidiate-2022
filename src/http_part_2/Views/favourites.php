<?php

require_once __DIR__ . './../../../config/bootstrap.php';

use http_part_2\Controllers\FavouritesController;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$favouriteController = new FavouritesController($entityManager);

$favourites = $favouriteController->getAllFavourites();
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
    <br/>
    <h3>Favourites</h3>
    <br/>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Image id</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        <?php
        for ($i = 0; $i < count($favourites); $i++):
            ?>
            <tr>
                <td><?=$favourites[$i]->getId()?></td>
                <td><?=$favourites[$i]->getImageId()?></td>
                <td>
                    <form action="../Actions/singleFavouriteImage.php" method="GET">
                        <input type="hidden" name="id" value="<?=$favourites[$i]->getId()?>"/>
                        <input type="submit" class="btn btn-success" value="Get"/>
                    </form>
                    <br/>
                    <form action="../Actions/deleteFromFavourites.php" method="POST">
                        <input type="hidden" name="id" value="<?=$favourites[$i]->getId()?>"/>
                        <input type="submit" class="btn btn-dark" value="Remove from favourites"/>
                    </form>
                </td>
            </tr>
        <?php endfor; ?>

        </tbody>
    </table>
</main>
</html>