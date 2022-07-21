<?php

namespace solid\Seeders;

use solid\Repositories\MagazineRepository;

require_once __DIR__ . './../../../config/bootstrap.php';

$magazinesCount = $argv[1] ?? 20;

$magazinesData = [
    [
        'name' => 'Test book 1',
        'description' => 'Scrambled it to make a type specimen book',
        'numberOfPages' => 220,
        'hardCover' => true,
    ],
    [
        'name' => 'Test book 4',
        'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        'numberOfPages' => 290,
        'hardCover' => true,
    ],
    [
        'name' => 'Test book 3',
        'description' => 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged',
        'numberOfPages' => 100,
        'hardCover' => true,
    ],
    [
        'name' => 'Test book 5',
        'description' => 'The point of using Lorem Ipsum is that it has a more-or-less normal distribution',
        'numberOfPages' => 25,
        'hardCover' => true,
    ],
    [
        'name' => 'Test book 2',
        'description' => 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose',
        'numberOfPages' => 22,
        'hardCover' => false,
    ],
    [
        'name' => 'Test book 2',
        'description' => 'Contrary to popular belief, Lorem Ipsum is not simply random text',
        'numberOfPages' => 120,
        'hardCover' => true,
    ],
];

$connection = $entityManager->getConnection();
$connection->beginTransaction();

$bookRepository = new MagazineRepository($entityManager);

$connection->query('DELETE FROM magazines');
$connection->query('ALTER TABLE magazines AUTO_INCREMENT = 1');

for ($i = 0; $i < $magazinesCount; $i++) {
    $bookRepository->create($magazinesData[array_rand($magazinesData)]);
}
