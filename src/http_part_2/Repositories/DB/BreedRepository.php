<?php

namespace http_part_2\Repositories\DB;

use Doctrine\ORM\EntityManagerInterface;
use http_part_2\Entities\Breed;
use http_part_2\Repositories\Interfaces\BreedRepositoryInterface;

class BreedRepository implements BreedRepositoryInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function getAll(): array
    {
        return $this->entityManager->getRepository(Breed::class)->findAll();
    }

    public function searchByName(string $name): array
    {
        return $this->entityManager->getRepository(Breed::class)->findBy([
            'name' => $name,
        ]);
    }
}