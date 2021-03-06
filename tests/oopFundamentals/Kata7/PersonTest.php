<?php

namespace Tests\oopFundamentals\Kata7;

use PHPUnit\Framework\TestCase;
use oopFundamentals\Kata7\Person;

class PersonTest extends TestCase
{
    protected Person $person;

    protected function setUp(): void
    {
        parent::setUp();

        $age = 20;
        $name = 'Peter Parker';
        $occupation = 'Student';

        $this->person = new Person($age, $name, $occupation);
    }

    public function testIntroduceWorksCorrectly()
    {
        $this->assertSame(sprintf(Person::INTRODUCE_FORMAT, $this->person->getName()), $this->person->introduce());
    }

    public function testDescribeJobWorksCorrectly()
    {
        $this->assertSame(sprintf(Person::DESCRIBE_JOB_FORMAT, $this->person->getOccupation()), $this->person->describeJob());
    }

    public function testGreetExtraterrestrialsWorksCorrectly()
    {
        $this->assertSame(sprintf(Person::GREET_EXTRATERRESTRIALS_FORMAT, Person::SPECIES), $this->person->greetExtraterrestrials());
    }
}