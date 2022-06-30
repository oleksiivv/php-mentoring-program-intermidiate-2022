<?php

namespace tests\oopFundamentals\Kata6;

use PHPUnit\Framework\TestCase;
use src\oopFundamentals\Kata6\Person;

class PersonTest extends TestCase
{
    public function testConstructorSetPropertiesCorrectly()
    {
        $age = 20;
        $name = 'Peter Parker';
        $occupation = 'Student';

        $person = new Person($age, $name, $occupation);

        $this->assertSame($age, $person->getAge());
        $this->assertSame($name, $person->getName());
        $this->assertSame($occupation, $person->getOccupation());
    }

    public function testAgeValidationWorksCorrectly()
    {
        $age = -20;
        $name = 'Peter Parker';
        $occupation = 'Student';

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(Person::AGE_VALIDATION_ERROR_MESSAGE);

        (new Person($age, $name, $occupation));
    }

    public function testOccupationValidationWorksCorrectly()
    {
        $age = 20;
        $name = 'Peter Parker';
        $occupation = null;

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(Person::OCCUPATION_VALIDATION_ERROR);

        (new Person($age, $name, $occupation));
    }

    public function testNameValidationWorksCorrectly()
    {
        $age = 20;
        $name = 11;
        $occupation = 'Student';

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(Person::NAME_VALIDATION_ERROR);

        (new Person($age, $name, $occupation));
    }

    public function testSettersWorksCorrectly()
    {
        $person = new Person(11, 'John Doe', 'Waiter');

        $age = 20;
        $name = 'Peter Parker';
        $occupation = 'Student';

        $person->setAge($age)
            ->setName($name)
            ->setOccupation($occupation);

        $this->assertSame($age, $person->getAge());
        $this->assertSame($name, $person->getName());
        $this->assertSame($occupation, $person->getOccupation());
    }
}