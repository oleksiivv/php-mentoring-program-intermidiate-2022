<?php

namespace http_part_2\Repositories\DB;

use Doctrine\ORM\EntityManagerInterface;
use http_part_2\Entities\Settings;

class SettingsRepository
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function getByUser(string $userApiKey): Settings
    {
        return $this->entityManager->getRepository(Settings::class)->findOneBy(['user_api_key' => $userApiKey]);
    }

    public function save(Settings $setting): void
    {
        $this->entityManager->persist($setting);
        $this->entityManager->flush();
    }
}