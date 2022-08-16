<?php

namespace Patterns\DecoratorPattern\Decorators;

use Patterns\DecoratorPattern\Entities\Person;

class UpperCaseWritePersonDecorator extends PersonRepositoryBaseDecorator
{
    public function savePerson(Person $person): void
    {
        $person->setName(strtoupper($person->getName()));

        parent::savePerson($person);
    }
}