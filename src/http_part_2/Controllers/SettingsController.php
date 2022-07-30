<?php

namespace http_part_2\Controllers;

use Doctrine\ORM\EntityManagerInterface;
use http_part_2\Entities\FavouriteBreed;
use http_part_2\Repositories\DB\SettingsRepository;
use http_part_2\Repositories\FavouritesHttpRepository;
use http_part_2\Services\BreedRepositoryFactory;
use http_part_2\Services\HttpService;
use http_part_2\Services\LogService;

class SettingsController extends Controller
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
        parent::__construct(new SettingsRepository($this->entityManager), new LogService($this->entityManager));
    }

    public function setOfflineMode(bool $active): void
    {
        $settings = $this->settingsRepository->getByUser(HttpService::X_API_KEY);
        $settings->setOfflineMode($active);

        $this->entityManager->persist($settings);
        $this->entityManager->flush();

        $this->logService->log(['offline' => $active], LogService::LOG_TYPE_UPDATE_SETTINGS);
    }

    public function setResponseCaching(bool $active): void
    {
        $settings = $this->settingsRepository->getByUser(HttpService::X_API_KEY);
        $settings->setResponseCaching($active);

        $this->entityManager->persist($settings);
        $this->entityManager->flush();

        $this->logService->log(['caching' => $active], LogService::LOG_TYPE_UPDATE_SETTINGS);
    }

    public function setLogging(bool $active): void
    {
        $settings = $this->settingsRepository->getByUser(HttpService::X_API_KEY);
        $settings->setLogging($active);

        $this->entityManager->persist($settings);
        $this->entityManager->flush();

        $this->logService->log(['logging' => $active], LogService::LOG_TYPE_UPDATE_SETTINGS);
    }
}