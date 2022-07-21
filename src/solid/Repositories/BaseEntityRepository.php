<?php

namespace solid\Repositories;

use Doctrine\ORM\EntityManagerInterface;
use solid\Entities\Interfaces\BaseEntity;
use solid\Repositories\Interfaces\ReadableObjectRepositoryInterface;

abstract class BaseEntityRepository implements ReadableObjectRepositoryInterface
{
    public function __construct(
        protected EntityManagerInterface $entityManager,
        protected string $entityName,
    ) {
    }

    public function index(int $start=0, int $offset=10, ?array $order = null, ?array $criteria = []): array
    {
        return $this->entityManager->getRepository($this->entityName)->findBy($criteria, $order, $offset, $start);
    }

    public function find(int $id): ?BaseEntity
    {
        return $this->entityManager->find($this->entityName, $id);
    }

    public function delete(int $id): void
    {
        $article = $this->entityManager->getPartialReference($this->entityName, $id);

        $this->entityManager->remove($article);
        $this->entityManager->flush();
    }

    public function getNumberOfRecords(?array $criteria = []): int
    {
        return $this->entityManager->getRepository($this->entityName)
            ->count($criteria);
    }
}