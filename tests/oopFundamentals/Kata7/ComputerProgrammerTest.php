<?php

namespace Tests\oopFundamentals\Kata7;

use PHPUnit\Framework\TestCase;
use oopFundamentals\Kata7\ComputerProgrammer;

class ComputerProgrammerTest extends TestCase
{
    public function testIntroduceWorksCorrectly()
    {
        $age = 20;
        $name = 'Peter Parker';
        $occupation = 'Student';

        $person = new ComputerProgrammer($age, $name, $occupation);

        $this->assertSame(sprintf(ComputerProgrammer::INTRODUCE_FORMAT, $name, $occupation), $person->introduce());
    }
}