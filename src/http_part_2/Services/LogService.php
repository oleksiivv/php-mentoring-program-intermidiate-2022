<?php

namespace http_part_2\Services;

use Doctrine\ORM\EntityManagerInterface;
use http_part_2\Entities\Log;

class LogService
{
    public const LOG_TYPE_GET_BREEDS = 'get all breeds';

    public const LOG_TYPE_SEARCH_BREEDS = 'search breeds';

    public const LOG_TYPE_GET_FAVOURITE_IMAGES = 'get favourite images';

    public const LOG_TYPE_GET_FAVOURITE_IMAGE = 'get favourite image';

    public const LOG_TYPE_CREATE_FAVOURITE_IMAGE = 'create favourite image';

    public const LOG_TYPE_DELETE_FAVOURITE_IMAGE = 'delete favourite image';

    public const LOG_TYPE_UPDATE_SETTINGS = 'update settings';

    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function log(array $data, string $type): void
    {
        $log = new Log();

        $log->setLog($data);
        $log->setType($type);
        $log->setTimestamp(date("Y-m-d H:i:s"));
        $log->setUserApiKey(HttpService::X_API_KEY);

        $this->entityManager->persist($log);
        $this->entityManager->flush();
    }
}