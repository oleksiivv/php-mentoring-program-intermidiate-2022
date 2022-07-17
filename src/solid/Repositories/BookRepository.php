<?php

namespace solid\Repositories;

use db\Entities\Article;
use Doctrine\ORM\EntityManagerInterface;
use solid\Entities\Book;
use solid\Entities\Interfaces\BaseEntity;

class BookRepository extends BaseEntityRepository
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, Book::class);
    }

    public function create(array $data): BaseEntity
    {
        $book = new Book();

        $book->setName($data['name']);
        $book->setDescription($data['description']);
        $book->setHardCover($data['hardCover'] ?? true);
        $book->setNumberOfPages($data['numberOfPages']);
        $book->setAuthorFullName($data['authorFullName']);

        $this->entityManager->persist($book);
        $this->entityManager->flush();

        return $book;
    }

    public function update(int $id, array $data): BaseEntity
    {
        $book = $this->entityManager->find($this->entityName, $id);

        $book->setName($data['name']);
        $book->setDescription($data['description']);
        $book->setHardCover($data['hardCover'] ?? true);
        $book->setNumberOfPages($data['numberOfPages']);
        $book->setAuthorFullName($data['authorFullName']);

        $this->entityManager->persist($book);
        $this->entityManager->flush();

        return $book;
    }
}