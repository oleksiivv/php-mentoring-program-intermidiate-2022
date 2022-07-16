<?php

namespace Tests\oopFundamentals\Kata8;

use PHPUnit\Framework\TestCase;
use oopFundamentals\Kata8\CanClimb;
use oopFundamentals\Kata8\CanFly;
use oopFundamentals\Kata8\CanGreet;
use oopFundamentals\Kata8\CanIntroduce;
use oopFundamentals\Kata8\CanSpeak;
use oopFundamentals\Kata8\CanSwim;
use oopFundamentals\Kata8\Entities\Bird;
use oopFundamentals\Kata8\Entities\Cat;
use oopFundamentals\Kata8\Entities\Dog;
use oopFundamentals\Kata8\Entities\Duck;
use oopFundamentals\Kata8\Entities\Person;

class HierarchyTest extends TestCase
{
    public function testBirdIsCorrect()
    {
        $this->assertInstanceOf(CanFly::class, (new Bird('Birdy')));
    }

    public function testDuckIsCorrect()
    {
        $duck = new Duck('Ducky');

        $this->assertInstanceOf(Bird::class, $duck);
        $this->assertInstanceOf(CanSwim::class, $duck);
    }

    public function testPersonIsCorrect()
    {
        $age = 20;
        $name = 'Peter Parker';
        $occupation = 'Student';

        $person = new Person($age, $name, $occupation);

        $this->assertInstanceOf(CanGreet::class, $person);
        $this->assertInstanceOf(CanSpeak::class, $person);
        $this->assertInstanceOf(CanIntroduce::class, $person);
    }

    public function testCatIsCorrect()
    {
        $this->assertInstanceOf(CanClimb::class, (new Cat()));
    }

    public function testDogIsCorrect()
    {
        $dog = new Dog();

        $this->assertInstanceOf(CanSwim::class, $dog);
        $this->assertInstanceOf(CanGreet::class, $dog);
    }
}