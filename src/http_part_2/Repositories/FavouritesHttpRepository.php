<?php

namespace http_part_2\Repositories;

use http_part_2\Entities\FavouriteBreed;
use http_part_2\Services\HttpService;

class FavouritesHttpRepository
{
    private HttpService $httpService;

    public function __construct(bool $isResponseCaching)
    {
        $this->httpService = new HttpService($isResponseCaching);
    }

    public function getAll(?string $subId = null, ?int $page = null, ?int $limit = null): array
    {
        $items = json_decode($this->httpService->get('/favourites', array_filter([
            'sub_id' => $subId,
            'page' => $page,
            'limit' => $limit,
        ]))->getBody());

        return array_map(function ($item) {
           return FavouriteBreed::fromArray(get_object_vars($item));
        }, $items);
    }

    public function get(string $id): FavouriteBreed
    {
        $response = json_decode($this->httpService->get("/favourites/$id")->getBody());

        return FavouriteBreed::fromArray(get_object_vars($response));
    }

    public function create(array $data): void
    {
        $this->httpService->post('/favourites', $data);
    }

    public function delete(string $id): void
    {
        $this->httpService->delete("/favourites/$id");
    }
}