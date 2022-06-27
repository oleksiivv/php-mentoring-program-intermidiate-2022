<?php

namespace tests\oopFundamentals\Kata7;

use PHPUnit\Framework\TestCase;
use src\oopFundamentals\Kata7\Person;

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
        $this->assertSame(sprintf(Person::INTRODUCE_STRING, $this->person->getName()), $this->person->introduce());
    }

    public function testDescribeJobWorksCorrectly()
    {
        $this->assertSame(sprintf(Person::DESCRIBE_JOB_STRING, $this->person->getOccupation()), $this->person->describeJob());
    }

    public function testGreetExtraterrestrialsWorksCorrectly()
    {
        $this->assertSame(sprintf(Person::GREET_EXTRATERRESTRIALS_STRING, Person::SPECIES), $this->person->greetExtraterrestrials());
    }
}