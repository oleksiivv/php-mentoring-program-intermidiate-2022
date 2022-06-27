<?php

namespace tests\oopFundamentals\Kata9;

use PHPUnit\Framework\TestCase;
use src\oopFundamentals\Kata9\Person;
use src\oopFundamentals\Kata9\Child;

class ChildTest extends TestCase
{
    protected Child $child;

    protected int $age;

    protected string $name;

    protected string $gender;

    protected array $aspirations;

    protected function setUp(): void
    {
        parent::setUp();

        $this->age = 5;
        $this->name = 'Barry Allen';
        $this->gender = Person::GENDER_MALE;
        $this->aspirations = ['Teacher', 'Doctor', 'Police Officer'];

        $this->child = new Child($this->age, $this->name, $this->gender, $this->aspirations);
    }

    public function testIntroduceWorksCorrectly()
    {
        $this->assertSame(sprintf(Child::INTRODUCE_STRING, $this->name, $this->age), $this->child->introduce());
    }

    public function testGreetWorksCorrectly()
    {
        $name = 'Bruce';

        $this->assertSame(sprintf(Child::GREET_STRING, $name), $this->child->greet($name));
    }

    public function testSayDreamsWorksCorrectly()
    {
        $aspirations = 'Teacher, Doctor, Police Officer';

        $this->assertSame(sprintf(Child::DREAMS_STRING, $aspirations), $this->child->sayDreams());
    }
}