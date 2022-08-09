<?php

namespace http_part_2\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use http_part_2\Entities\Breed;

/**
 * @ORM\Entity
 * @ORM\Table(name="settings")
 */
class Settings
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private int $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $user_api_key;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $logging;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $responseCaching;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $offlineMode;

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param bool $logging
     */
    public function setLogging(bool $logging): void
    {
        $this->logging = $logging;
    }

    /**
     * @return bool
     */
    public function isLogging(): bool
    {
        return $this->logging;
    }

    /**
     * @param bool $offlineMode
     */
    public function setOfflineMode(bool $offlineMode): void
    {
        $this->offlineMode = $offlineMode;
    }

    /**
     * @return bool
     */
    public function isOfflineMode(): bool
    {
        return $this->offlineMode;
    }

    /**
     * @param bool $responseCaching
     */
    public function setResponseCaching(bool $responseCaching): void
    {
        $this->responseCaching = $responseCaching;
    }

    /**
     * @return bool
     */
    public function isResponseCaching(): bool
    {
        return $this->responseCaching;
    }

    /**
     * @param string $user_api_key
     */
    public function setUserApiKey(string $user_api_key): void
    {
        $this->user_api_key = $user_api_key;
    }

    /**
     * @return string
     */
    public function getUserApiKey(): string
    {
        return $this->user_api_key;
    }
}