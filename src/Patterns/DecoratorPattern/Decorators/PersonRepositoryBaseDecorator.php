<?php

namespace Patterns\DecoratorPattern\Decorators;

use Patterns\DecoratorPattern\Entities\Person;

class PersonRepositoryBaseDecorator implements PersonRepositoryInterface
{
    public function __construct(private PersonRepositoryInterface $personRepository)
    {
    }

    public function savePerson(Person $person): void
    {
        $this->personRepository->savePerson($person);
    }

    public function readPeoples(): array
    {
        return $this->personRepository->readPeoples();
    }

    public function readPerson(string $name): ?Person
    {
        return $this->personRepository->readPerson($name);
    }
}