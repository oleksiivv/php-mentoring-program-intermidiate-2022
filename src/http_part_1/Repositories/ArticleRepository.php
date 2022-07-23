<?php

namespace http_part_1\Repositories;

use http_part_1\Entities\Article;
use Doctrine\ORM\EntityManagerInterface;

class ArticleRepository
{
    const PAGINATION_ITEMS_PER_PAGE = 5;
    const PAGINATION_NAVBAR_OFFSET_FROM_CURRENT_PAGE = 2;

    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function index(int $start=0, int $offset=10, ?array $order = null, ?array $criteria = []): array
    {
        return $this->entityManager->getRepository(Article::class)->findBy($criteria, $order, $offset, $start);
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