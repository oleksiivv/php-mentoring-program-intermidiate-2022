<?php

namespace http_part_2\Seeders;

use http_part_2\Repositories\FavouritesHttpRepository;

require_once __DIR__ . './../../../config/bootstrap.php';

$connection = $entityManager->getConnection();
$connection->beginTransaction();

$connection->query('DELETE FROM favourite_breeds');
$connection->query('ALTER TABLE favourite_breeds AUTO_INCREMENT = 1');

$favourites = (new FavouritesHttpRepository(false))->getAll();

foreach ($favourites as $favourite) {
    $entityManager->persist($favourite);
}

$entityManager->flush();