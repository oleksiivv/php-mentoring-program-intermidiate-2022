<?php

namespace solid\Repositories;

use Doctrine\ORM\EntityManagerInterface;
use solid\Entities\EBook;
use solid\Entities\Interfaces\BaseEntity;

class EBookRepository extends BaseEntityRepository
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, EBook::class);
    }

    public function create(array $data): BaseEntity
    {
        $eBook = new EBook();

        $eBook->setName($data['name']);
        $eBook->setDescription($data['description']);
        $eBook->setNumberOfPages($data['numberOfPages']);
        $eBook->setAuthorFullName($data['authorFullName']);

        $this->entityManager->persist($eBook);
        $this->entityManager->flush();

        return $eBook;
    }

    public function update(int $id, array $data): BaseEntity
    {
        $eBook = $this->entityManager->find($this->entityName, $id);

        $eBook->setName($data['name']);
        $eBook->setDescription($data['description']);
        $eBook->setNumberOfPages($data['numberOfPages']);
        $eBook->setAuthorFullName($data['authorFullName']);

        $this->entityManager->persist($eBook);
        $this->entityManager->flush();

        return $eBook;
    }
}