<?php

namespace http_part_2\Controllers;

use http_part_2\Repositories\DB\SettingsRepository;
use http_part_2\Services\HttpService;
use http_part_2\Services\LogService;

class Controller
{
    protected bool $isOffline;

    protected bool $isLogging;
    
    protected bool $isResponseCaching;

    public function __construct(
        protected SettingsRepository $settingsRepository,
        protected LogService $logService,
    ) {
        $this->isOffline = $this->settingsRepository->getByUser(HttpService::X_API_KEY)->isOfflineMode();
        $this->isLogging = $this->settingsRepository->getByUser(HttpService::X_API_KEY)->isLogging();
        $this->isResponseCaching = $this->settingsRepository->getByUser(HttpService::X_API_KEY)->isResponseCaching();
    }
}