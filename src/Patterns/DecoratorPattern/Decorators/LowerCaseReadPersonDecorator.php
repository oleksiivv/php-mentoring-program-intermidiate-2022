<?php

namespace Patterns\DecoratorPattern\Decorators;

use Patterns\DecoratorPattern\Entities\Person;

class LowerCaseReadPersonDecorator extends PersonRepositoryBaseDecorator
{
    public function readPeoples(): array
    {
        $peoples = parent::readPeoples();

        return array_map(function ($item) {
            $item->setName(strtolower($item->getName()));

            return $item;
        }, $peoples);
    }

    public function readPerson(string $name): ?Person
    {
        $person = parent::readPerson($name);

        $person?->setName(strtolower($person->getName()));

        return $person;
    }
}