<?php

require_once __DIR__ . './../../../config/bootstrap.php';

use http_part_2\Controllers\SettingsController;
use http_part_2\Services\HttpService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$settingsController = new SettingsController($entityManager);

$settingsController->setLogging($request->get('logging') !== null);

$settingsController->setOfflineMode($request->get('offline') !== null);

$settingsController->setResponseCaching($request->get('caching') !== null);

$response = new RedirectResponse(HttpService::BASE_LOCAL_URL);

$response->send();