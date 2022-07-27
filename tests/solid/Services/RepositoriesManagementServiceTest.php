<?php

namespace Tests\solid\Services;

use solid\Entities\Book;
use solid\Entities\EBook;
use solid\Entities\Magazine;
use solid\Repositories\BookRepository;
use solid\Repositories\EBookRepository;
use solid\Repositories\MagazineRepository;
use solid\Services\HttpService;
use PHPUnit\Framework\TestCase;
use solid\Services\RepositoriesManagementService;
use Tests\solid\DoctrineTestCase;

class RepositoriesManagementServiceTest extends TestCase
{
    use DoctrineTestCase;

    protected RepositoriesManagementService $repositoriesManagementService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repositoriesManagementService = new RepositoriesManagementService($this->getEntityManager());
    }
    public function testGetRepositoryWorksCorrectly()
    {
        $entitiesAndRepositories = [
            Book::class => BookRepository::class,
            EBook::class => EBookRepository::class,
            Magazine::class => MagazineRepository::class,
        ];

        foreach ($entitiesAndRepositories as $entity => $repository) {
            $this->assertInstanceOf($repository, $this->repositoriesManagementService->getRepository($entity));
        }
    }
}