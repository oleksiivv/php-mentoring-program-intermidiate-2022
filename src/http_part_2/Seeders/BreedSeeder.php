<?php

namespace http_part_2\Seeders;

use http_part_2\Entities\Breed;
use http_part_2\Repositories\BreedHttpRepository;

require_once __DIR__ . './../../../config/bootstrap.php';

$connection = $entityManager->getConnection();
$connection->beginTransaction();

$connection->query('DELETE FROM breeds');
$connection->query('ALTER TABLE breeds AUTO_INCREMENT = 1');

$breeds = (new BreedHttpRepository(false))->getAll();

foreach ($breeds as $breed) {
    $entityManager->persist($breed);
}

$entityManager->flush();