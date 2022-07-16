<?php

namespace Tests\oopFundamentals\Kata9;

use PHPUnit\Framework\TestCase;
use oopFundamentals\Kata9\ComputerProgrammer;
use oopFundamentals\Kata9\Person;

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
            sprintf(ComputerProgrammer::INTRODUCE_FORMAT, $this->name, $this->age, ComputerProgrammer::OCCUPATION),
            $this->computerProgrammer->introduce(),
        );
    }

    public function testGreetWorksCorrectly()
    {
        $name = 'Bruce';

        $this->assertSame(
            sprintf(ComputerProgrammer::GREET_FORMAT, $name, $this->computerProgrammer->name),
            $this->computerProgrammer->greet($name),
        );
    }

    public function testAdvertiseWorksCorrectly()
    {
        $this->assertSame(ComputerProgrammer::ADVERTISE_FORMAT, $this->computerProgrammer->advertise());
    }
}