<?php

namespace http_part_2\Controllers;

use Doctrine\ORM\EntityManagerInterface;
use http_part_2\Repositories\DB\SettingsRepository;
use http_part_2\Services\BreedRepositoryFactory;
use http_part_2\Services\LogService;

class BreedController extends Controller
{
    private BreedRepositoryFactory $breedRepositoryFactory;

    public function __construct(private EntityManagerInterface $entityManager)
    {
        parent::__construct(new SettingsRepository($this->entityManager), new LogService($this->entityManager));

        $this->breedRepositoryFactory = new BreedRepositoryFactory($this->entityManager);
    }

    public function getAllBreeds(): array
    {
        if ($this->isLogging) {
            $this->logService->log([], LogService::LOG_TYPE_GET_BREEDS);
        }

        return $this->breedRepositoryFactory->getRepository($this->isOffline, $this->isResponseCaching)
            ->getAll();
    }

    public function searchBreed(string $name): array
    {
        if ($this->isLogging) {
            $this->logService->log(['name' => $name], LogService::LOG_TYPE_SEARCH_BREEDS);
        }

        return $this->breedRepositoryFactory->getRepository($this->isOffline)
            ->searchByName($name);
    }
}