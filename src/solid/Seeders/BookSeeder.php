<?php

namespace solid\Seeders;

use solid\Repositories\BookRepository;

require_once __DIR__ . './../../../config/bootstrap.php';

$booksCount = $argv[1] ?? 20;

$booksData = [
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

$bookRepository = new BookRepository($entityManager);

$connection->query('DELETE FROM books');
$connection->query('ALTER TABLE books AUTO_INCREMENT = 1');

for ($i = 0; $i < $booksCount; $i++) {
    $bookRepository->create($booksData[array_rand($booksData)]);
}
