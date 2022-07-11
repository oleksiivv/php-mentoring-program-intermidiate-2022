<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once __DIR__ . './../vendor/autoload.php';

$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;

$config = Setup::createAnnotationMetadataConfiguration(
    [__DIR__ . './../src/db/Entities'], $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader
);

$connection = [
    'driver' => 'pdo_mysql',
    'user' => 'root',
    'host' => 'localhost',
    'dbname' => 'Articles',
];

$entityManager = EntityManager::create($connection, $config);