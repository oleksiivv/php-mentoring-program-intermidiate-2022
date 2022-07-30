<?php

namespace http_part_2\Services;

use Doctrine\ORM\EntityManagerInterface;
use http_part_2\Repositories\BreedHttpRepository;
use http_part_2\Repositories\DB\BreedRepository;
use http_part_2\Repositories\Interfaces\BreedRepositoryInterface;

class BreedRepositoryFactory
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function getRepository(bool $isOfflineMode, bool $isResponseCaching = false): BreedRepositoryInterface
    {
        return $isOfflineMode
            ? new BreedRepository($this->entityManager)
            : new BreedHttpRepository($isResponseCaching);
    }
}