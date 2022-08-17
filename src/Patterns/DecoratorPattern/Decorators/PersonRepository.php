<?php

namespace Patterns\DecoratorPattern\Decorators;

use Doctrine\ORM\EntityManagerInterface;
use Patterns\DecoratorPattern\Entities\Person;

class PersonRepository implements PersonRepositoryInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function savePerson(Person $person): void
    {
        $this->entityManager->persist($person);
        $this->entityManager->flush();
    }

    public function readPeoples(): array
    {
        return $this->entityManager->getRepository(Person::class)->findAll();
    }

    public function readPerson(string $name): ?Person
    {
        return $this->entityManager->getRepository(Person::class)->findOneBy(['name' => $name]);
    }
}