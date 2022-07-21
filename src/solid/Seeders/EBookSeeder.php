<?php

namespace solid\Seeders;

use solid\Repositories\BookRepository;
use solid\Repositories\EBookRepository;

require_once __DIR__ . './../../../config/bootstrap.php';

$eBooksCount = $argv[1] ?? 20;

$eBooksData = [
    [
        'name' => 'Test book 1',
        'description' => 'Scrambled it to make a type specimen book',
        'numberOfPages' => 225,
        'hardCover' => true,
        'authorFullName' => 'J J Johns',
    ],
    [
        'name' => 'Test book 4',
        'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        'numberOfPages' => 230,
        'hardCover' => true,
        'authorFullName' => 'J J Johns',
    ],
    [
        'name' => 'Test book 3',
        'description' => 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged',
        'numberOfPages' => 760,
        'hardCover' => true,
        'authorFullName' => 'J J Johns',
    ],
    [
        'name' => 'Test book 5',
        'description' => 'The point of using Lorem Ipsum is that it has a more-or-less normal distribution',
        'numberOfPages' => 220,
        'hardCover' => true,
        'authorFullName' => 'J J Johns',
    ],
    [
        'name' => 'Test book 2',
        'description' => 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose',
        'numberOfPages' => 340,
        'hardCover' => true,
        'authorFullName' => 'J J Johns',
    ],
    [
        'name' => 'Test book 2',
        'description' => 'Contrary to popular belief, Lorem Ipsum is not simply random text',
        'numberOfPages' => 320,
        'hardCover' => true,
        'authorFullName' => 'J J Johns',
    ],
];

$connection = $entityManager->getConnection();
$connection->beginTransaction();

$eBookRepository = new EBookRepository($entityManager);

$connection->query('DELETE FROM e_books');
$connection->query('ALTER TABLE e_books AUTO_INCREMENT = 1');

for ($i = 0; $i < $eBooksCount; $i++) {
    $eBookRepository->create($eBooksData[array_rand($eBooksData)]);
}
