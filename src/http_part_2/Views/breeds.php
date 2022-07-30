<?php

require_once __DIR__ . './../../../config/bootstrap.php';

use http_part_2\Controllers\BreedController;
use http_part_2\Controllers\FavouritesController;
use http_part_2\Entities\Favourite;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$breedController = new BreedController($entityManager);

$favouritesController = new FavouritesController($entityManager);

try {
    $favouriteImages = array_map(function (Favourite $item) {
        return $item->getImageId();
    }, $favouritesController->getAllFavourites());
} catch (Exception $exception) {
    $favouriteImages = [];
}

$breeds = $request->get('search-name') === null
    ? $breedController->getAllBreeds()
    : $breedController->searchBreed($request->get('search-name'));
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

    <h3>Breeds</h3>
    <br/>
    <h4>Search by name</h4>
    <form action="" method="GET">
        <input name="search-name" type="text" placeholder="Title: " value="<?= Request::createFromGlobals()->get('search-name') ?? '' ?>" class="form-control"/>

        <input type="submit" name="search" class="btn btn-primary" value="Submit"/>
    </form>
    <br/>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Temperament</th>
            <th scope="col">Life span</th>
            <th scope="col">Wikipedia</th>
            <th scope="col">Image id</th>
            <th scope="col">Origin</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        <?php
        for ($i = 0; $i < count($breeds); $i++):
            ?>
            <tr>
                <td><?=$breeds[$i]->getName()?></td>
                <td><?=$breeds[$i]->getTemperament()?></td>
                <td><?=$breeds[$i]->getLifeSpan()?></td>
                <td><?=$breeds[$i]->getWikipediaUrl()?></td>
                <td><?=$breeds[$i]->getImageId()?></td>
                <td><?=$breeds[$i]->getOrigin()?></td>
                <td>
                    <?php
                    if (! in_array($breeds[$i]->getImageId(), $favouriteImages)):
                        ?>
                        <form action="../Actions/createFavouriteImage.php" method="POST">
                            <input type="hidden" name="image_id" value="<?=$breeds[$i]->getImageId()?>"/>
                            <input type="submit" class="btn btn-danger" value="Add to favourites"/>
                        </form>
                    <?php
                    else:
                        ?>
                        <p>Added to favourites</p>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endfor; ?>

        </tbody>
    </table>
</main>
</html>