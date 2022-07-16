<?php

namespace oopFundamentals\Kata8\Entities;

use oopFundamentals\Kata6\Person as BasePerson;
use oopFundamentals\Kata8\CanGreet;
use oopFundamentals\Kata8\CanIntroduce;

class Person extends BasePerson implements CanIntroduce, CanGreet
{

    public function greet(string $name): string
    {
        return sprintf('Hello %s, how are you?', $name);
    }

    public function introduce(): string
    {
        return sprintf(
            'Hello, my name is %s, I am %d years old and I am currently working as a(n) %s',
            $this->name, $this->age, $this->occupation,
        );
    }

    public function speak(): string
    {
        return 'What am I supposed to say again?';
    }
}