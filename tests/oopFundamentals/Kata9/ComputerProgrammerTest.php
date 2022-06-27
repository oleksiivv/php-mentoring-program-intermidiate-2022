<?php

namespace tests\oopFundamentals\Kata9;

use PHPUnit\Framework\TestCase;
use src\oopFundamentals\Kata9\ComputerProgrammer;
use src\oopFundamentals\Kata9\Person;

class ComputerProgrammerTest extends TestCase
{
    protected ComputerProgrammer $computerProgrammer;

    protected int $age;

    protected string $name;

    protected string $gender;

    protected function setUp(): void
    {
        parent::setUp();

        $this->age = 5;
        $this->name = 'Barry Allen';
        $this->gender = Person::GENDER_MALE;

        $this->computerProgrammer = new ComputerProgrammer($this->age, $this->name, $this->gender);
    }

    public function testIntroduceWorksCorrectly()
    {
        $this->assertSame(
            sprintf(ComputerProgrammer::INTRODUCE_STRING, $this->name, $this->age, ComputerProgrammer::OCCUPATION),
            $this->computerProgrammer->introduce(),
        );
    }

    public function testGreetWorksCorrectly()
    {
        $name = 'Bruce';

        $this->assertSame(
            sprintf(ComputerProgrammer::GREET_STRING, $name, $this->computerProgrammer->name),
            $this->computerProgrammer->greet($name),
        );
    }

    public function testAdvertiseWorksCorrectly()
    {
        $this->assertSame(ComputerProgrammer::ADVERTISE_STRING, $this->computerProgrammer->advertise());
    }
}