<?php

namespace solid\Services;

use Doctrine\ORM\EntityManagerInterface;
use solid\Entities\Book;
use solid\Entities\EBook;
use solid\Entities\Magazine;
use solid\Repositories\BookRepository;
use solid\Repositories\EBookRepository;
use solid\Repositories\Interfaces\ReadableObjectRepositoryInterface;
use solid\Repositories\MagazineRepository;

class RepositoriesManagementService
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function getRepository(string $entityName): ReadableObjectRepositoryInterface
    {
        return match ($entityName) {
            Book::class => new BookRepository($this->entityManager),
            EBook::class => new EBookRepository($this->entityManager),
            Magazine::class => new MagazineRepository($this->entityManager),
        };
    }
}