<?php

namespace http_part_2\Seeders;

use http_part_2\Entities\Settings;
use http_part_2\Repositories\DB\SettingsRepository;
use http_part_2\Services\HttpService;

require_once __DIR__ . './../../../config/bootstrap.php';

$connection = $entityManager->getConnection();
$connection->beginTransaction();

$connection->query('DELETE FROM settings');
$connection->query('ALTER TABLE settings AUTO_INCREMENT = 1');

$settings = new Settings();

$settings->setUserApiKey(HttpService::X_API_KEY);

$settings->setLogging(false);
$settings->setResponseCaching(false);
$settings->setOfflineMode(false);

(new SettingsRepository($entityManager))->save($settings);