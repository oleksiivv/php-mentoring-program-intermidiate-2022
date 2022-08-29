<?php

namespace phpAdvanced\Repositories;

use Carbon\Carbon;
use Doctrine\ORM\EntityManagerInterface;
use phpAdvanced\Entities\StatisticRecord;

class TextStatisticsRepository
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function find(string $textHash): ?StatisticRecord
    {
        return $this->entityManager->getRepository(StatisticRecord::class)->findOneBy([
            'textHash' => $textHash,
        ]);
    }

    public function getAll(string $sessionId): array
    {
        return $this->entityManager->getRepository(StatisticRecord::class)->findBy([
            'sessionId' => $sessionId,
        ]);
    }

    public function getAllInDateRange(string $sessionId, string $from, string $to): array
    {
        return $this->entityManager->getRepository(StatisticRecord::class)
            ->createQueryBuilder('s')
            ->where('s.sessionId = :sessionId')
            ->andWhere('s.timestamp BETWEEN :from AND :to')
            ->setParameter('sessionId', $sessionId)
            ->setParameter('from', $from)
            ->setParameter('to', $to)
            ->getQuery()
            ->getResult();
    }

    public function create(string $textHash, array $statistic, string $sessionId): StatisticRecord
    {
        $statisticRecord = new StatisticRecord();

        $statisticRecord->setStatistic($statistic);
        $statisticRecord->setTextHash($textHash);
        $statisticRecord->setTimestamp(date("Y-m-d H:i:s"));
        $statisticRecord->setSessionId($sessionId);

        $this->entityManager->persist($statisticRecord);
        $this->entityManager->flush();

        return $statisticRecord;
    }
}