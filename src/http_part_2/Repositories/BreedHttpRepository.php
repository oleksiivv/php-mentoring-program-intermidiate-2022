<?php

namespace http_part_2\Repositories;

use http_part_2\Entities\Breed;
use http_part_2\Repositories\Interfaces\BreedRepositoryInterface;
use http_part_2\Services\HttpService;

class BreedHttpRepository implements BreedRepositoryInterface
{
    private HttpService $httpService;

    public function __construct(bool $isResponseCaching)
    {
        $this->httpService = new HttpService($isResponseCaching);
    }

    public function getAll(): array
    {
        $response = json_decode($this->httpService->get('/breeds')->getBody()->getContents());

        return array_map(function ($item) {
            return Breed::fromArray(get_object_vars($item));
        }, $response);
    }

    public function searchByName(string $name): array
    {
        $response = json_decode($this->httpService->get("/breeds/search?q=$name")->getBody());

        return array_map(function ($item) {
            return Breed::fromArray(get_object_vars($item));
        }, $response);
    }
}