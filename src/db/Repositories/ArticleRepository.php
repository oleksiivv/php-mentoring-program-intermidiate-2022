<?php

namespace db\Repositories;

use db\Entities\Article;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

class ArticleRepository
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function index(int $start=0, int $offset=10, ?array $order = null, ?array $criteria = []): array
    {
        return $this->entityManager->getRepository(Article::class)->findBy($criteria, $order, $offset, $start);
    }

    /**
     * @deprecated
     */
    public function indexWithQueryBuilder(int $start=0, int $offset=10, ?array $orderBy = null, ?array $criteria = null): array
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();

        $queryBuilder->select('article')
            ->from(Article::class, 'article');

        if (isset($orderBy)) {
            $queryBuilder->orderBy('article.' . $orderBy['field'], $orderBy['order']);
        }

        $result = [];

        foreach ($this->paginate($queryBuilder, $start, $offset) as $entity) {
            $result[] = $entity;
        }

        return $result;
    }

    public function paginate(QueryBuilder $queryBuilder, int $start, int $offset): Paginator
    {
        $queryBuilder->setFirstResult($start)
            ->setMaxResults($start + $offset);

        $paginator = new Paginator($queryBuilder->getQuery(), true);

        return $paginator;
    }

    public function find(int $id): ?Article
    {
        return $this->entityManager->find(Article::class, $id);
    }

    public function create(array $data): Article
    {
        $article = new Article();

        $article->setTitle($data['title']);
        $article->setDescription($data['description']);

        $this->entityManager->persist($article);
        $this->entityManager->flush();

        return $article;
    }

    public function update(int $id, array $data): Article
    {
        $article = $this->entityManager->find(Article::class, $id);

        $article->setTitle($data['title']);
        $article->setDescription($data['description']);

        $this->entityManager->persist($article);
        $this->entityManager->flush();

        return $article;
    }

    public function delete(int $id): void
    {
        $article = $this->entityManager->getPartialReference(Article::class, $id);

        $this->entityManager->remove($article);
        $this->entityManager->flush();
    }

    public function getNumberOfRecords(?array $criteria = []): int
    {
        return $this->entityManager->getRepository(Article::class)
            ->count($criteria);
    }
}