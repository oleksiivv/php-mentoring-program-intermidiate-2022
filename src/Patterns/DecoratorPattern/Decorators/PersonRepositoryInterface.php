<?php

namespace Patterns\DecoratorPattern\Decorators;

use Patterns\DecoratorPattern\Entities\Person;

interface PersonRepositoryInterface
{
    public function savePerson(Person $person): void;

    public function readPeoples(): array;

    public function readPerson(string $name): ?Person;
}