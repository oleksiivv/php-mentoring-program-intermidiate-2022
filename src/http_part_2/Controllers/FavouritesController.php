<?php

namespace http_part_2\Controllers;

use Doctrine\ORM\EntityManagerInterface;
use Exception;
use http_part_2\Entities\Favourite;
use http_part_2\Repositories\DB\SettingsRepository;
use http_part_2\Repositories\FavouritesHttpRepository;
use http_part_2\Services\HttpService;
use http_part_2\Services\LogService;

class FavouritesController extends Controller
{
    private FavouritesHttpRepository $favouriteRepository;

    public function __construct(private EntityManagerInterface $entityManager)
    {
        parent::__construct(new SettingsRepository($this->entityManager), new LogService($this->entityManager));

        $this->favouriteRepository = new FavouritesHttpRepository($this->isResponseCaching);
    }

    public function getAllFavourites(): array
    {
        $this->throwExceptionIfOfflineMode();

        if ($this->isLogging) {
            $this->logService->log([], LogService::LOG_TYPE_GET_FAVOURITE_IMAGES);
        }

        return $this->favouriteRepository->getAll(HttpService::X_API_KEY);
    }

    public function getFavourite(string $id): Favourite
    {
        $this->throwExceptionIfOfflineMode();

        if ($this->isLogging) {
            $this->logService->log(['id' => $id], LogService::LOG_TYPE_GET_FAVOURITE_IMAGE);
        }

        return $this->favouriteRepository->get($id);
    }

    public function createFavourite(array $data): void
    {
        $this->throwExceptionIfOfflineMode();

        if ($this->isLogging) {
            $this->logService->log($data, LogService::LOG_TYPE_CREATE_FAVOURITE_IMAGE);
        }

        $this->favouriteRepository->create($data);
    }

    public function deleteFavourite(string $id): void
    {
        $this->throwExceptionIfOfflineMode();

        if ($this->isLogging) {
            $this->logService->log(['id' => $id], LogService::LOG_TYPE_DELETE_FAVOURITE_IMAGE);
        }

        $this->favouriteRepository->delete($id);
    }

    private function throwExceptionIfOfflineMode()
    {
        if ($this->isOffline) {
            throw new Exception('Favourites functionality disabled in offline mode', 422);
        }
    }
}