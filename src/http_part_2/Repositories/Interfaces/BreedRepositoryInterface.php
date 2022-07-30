<?php

namespace http_part_2\Repositories\Interfaces;

interface BreedRepositoryInterface
{
    public function getAll(): array;

    public function searchByName(string $name): array;
}