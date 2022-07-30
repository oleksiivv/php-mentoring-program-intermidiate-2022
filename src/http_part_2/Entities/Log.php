<?php

namespace http_part_2\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="logs")
 */
class Log
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
    private string $type;

    /**
     * @ORM\Column(type="string")
     */
    private string $userApiKey;

    /**
     * @ORM\Column(type="string")
     */
    private string $timestamp;

    /**
     * @ORM\Column(type="json")
     */
    private array $log;

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
     * @param array $log
     */
    public function setLog(array $log): void
    {
        $this->log = $log;
    }

    /**
     * @return array
     */
    public function getLog(): array
    {
        return $this->log;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $timestamp
     */
    public function setTimestamp(string $timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @return string
     */
    public function getTimestamp(): string
    {
        return $this->timestamp;
    }

    /**
     * @param string $userApiKey
     */
    public function setUserApiKey(string $userApiKey): void
    {
        $this->userApiKey = $userApiKey;
    }

    /**
     * @return string
     */
    public function getUserApiKey(): string
    {
        return $this->userApiKey;
    }
}