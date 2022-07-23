<?php

namespace http_part_1\Seeders;

use http_part_1\Entities\Article;

require_once __DIR__ . './../../../config/bootstrap.php';

$articlesCount = $argv[1] ?? 20;

$articlesData = [
    [
        'title' => 'Test title article 1',
        'description' => 'Scrambled it to make a type specimen book',
    ],
    [
        'title' => 'Test title article 4',
        'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
    ],
    [
        'title' => 'Test title article 3',
        'description' => 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged',
    ],
    [
        'title' => 'Test title article 5',
        'description' => 'The point of using Lorem Ipsum is that it has a more-or-less normal distribution',
    ],
    [
        'title' => 'Test title article 2',
        'description' => 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose',
    ],
    [
        'title' => 'Test title article 6',
        'description' => 'Contrary to popular belief, Lorem Ipsum is not simply random text',
    ],
];

$connection = $entityManager->getConnection();
$connection->beginTransaction();

$connection->query('DELETE FROM articles');
$connection->query('ALTER TABLE articles AUTO_INCREMENT = 1');

for ($i = 0; $i < $articlesCount; $i++) {
    $article = new Article();

    $article->setTitle($articlesData[array_rand($articlesData)]['title']);
    $article->setDescription($articlesData[array_rand($articlesData)]['description']);

    $entityManager->persist($article);
}

$entityManager->flush();