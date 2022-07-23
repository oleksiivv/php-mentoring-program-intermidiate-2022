<?php

require_once __DIR__ . './../../../../config/bootstrap.php';

use http_part_1\Repositories\ArticleRepository;
use http_part_1\Services\HttpService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$articleRepository = new ArticleRepository($entityManager);

$articleRepository->delete($request->get('delete-article-id'));

$response = new RedirectResponse(HttpService::BASE_LOCAL_URL);

$response->send();