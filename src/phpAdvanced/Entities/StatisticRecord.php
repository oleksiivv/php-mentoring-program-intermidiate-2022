<?php

namespace phpAdvanced\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="statistic_records")
 */
class StatisticRecord
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
    private string $textHash;

    /**
     * @ORM\Column(type="json")
     */
    private array $statistic;

    /**
     * @ORM\Column(type="string")
     */
    private string $timestamp;

    /**
     * @ORM\Column(type="string")
     */
    private string $sessionId;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTextHash(): string
    {
        return $this->textHash;
    }

    /**
     * @param string $textHash
     */
    public function setTextHash(string $textHash): void
    {
        $this->textHash = $textHash;
    }

    /**
     * @return array
     */
    public function getStatistic(): array
    {
        return $this->statistic;
    }

    /**
     * @param array $statistic
     */
    public function setStatistic(array $statistic): void
    {
        $this->statistic = $statistic;
    }

    /**
     * @return string
     */
    public function getTimestamp(): string
    {
        return $this->timestamp;
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
    public function getSessionId(): string
    {
        return $this->sessionId;
    }

    /**
     * @param string $sessionId
     */
    public function setSessionId(string $sessionId): void
    {
        $this->sessionId = $sessionId;
    }
}
