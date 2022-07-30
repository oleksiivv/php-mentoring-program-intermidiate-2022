<?php

require_once __DIR__ . './../../../../config/bootstrap.php';

use solid\Services\RepositoriesManagementService;

$repository = (new RepositoriesManagementService($entityManager))->getRepository($_POST['entity']);

$repository->find($_POST['id'])->export();