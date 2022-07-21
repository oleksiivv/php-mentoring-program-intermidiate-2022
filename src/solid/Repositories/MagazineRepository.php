<?php

namespace solid\Repositories;

use Doctrine\ORM\EntityManagerInterface;
use solid\Entities\Interfaces\BaseEntity;
use solid\Entities\Magazine;

class MagazineRepository extends BaseEntityRepository
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, Magazine::class);
    }

    public function create(array $data): BaseEntity
    {
        $magazine = new Magazine();

        $magazine->setName($data['name']);
        $magazine->setDescription($data['description']);
        $magazine->setHardCover($data['hardCover'] ?? true);
        $magazine->setNumberOfPages($data['numberOfPages']);

        $this->entityManager->persist($magazine);
        $this->entityManager->flush();

        return $magazine;
    }

    public function update(int $id, array $data): BaseEntity
    {
        $magazine = $this->entityManager->find($this->entityName, $id);

        $magazine->setName($data['name']);
        $magazine->setDescription($data['description']);
        $magazine->setHardCover($data['hardCover'] ?? true);
        $magazine->setNumberOfPages($data['numberOfPages']);

        $this->entityManager->persist($magazine);
        $this->entityManager->flush();

        return $magazine;
    }
}