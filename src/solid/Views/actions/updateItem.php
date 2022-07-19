<?php

require_once __DIR__ . './../../../../config/bootstrap.php';

use solid\Services\RepositoriesManagementService;

$repository = (new RepositoriesManagementService($entityManager))->getRepository($_POST['entity']);

$_POST['hardCover'] = isset($_POST['hardCover']) ? 1 : 0;

$repository->update(
    $_POST['update-entity-id'],
    $_POST,
);

unset($_GET['update']);

echo '<meta http-equiv="refresh" content="1; URL=../index.php" />';