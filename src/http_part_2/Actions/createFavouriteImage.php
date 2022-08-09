<?php

require_once __DIR__ . './../../../config/bootstrap.php';

use http_part_2\Controllers\BreedController;
use http_part_2\Controllers\FavouritesController;
use http_part_2\Services\HttpService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$favouriteController = new FavouritesController($entityManager);

$breedController = new BreedController($entityManager);

$favouriteController->createFavourite([
    'image_id' => $request->get('image_id'),
    'sub_id' => HttpService::X_API_KEY,
]);

$response = new RedirectResponse(HttpService::BASE_LOCAL_URL);

$response->send();