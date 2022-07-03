<?php

namespace src\oopFundamentals\Kata9;

class ComputerProgrammer extends Person
{
    public const OCCUPATION = 'Computer Programmer';

    public const INTRODUCE_FORMAT = 'Hello, my name is %s, I am %d years old and I am a(n) %s';
    public const GREET_FORMAT = 'Hello %s, I\'m %s, nice to meet you';
    public const ADVERTISE_FORMAT = 'Don\'t forget to check out my coding projects';

    public function introduce(): string
    {
        return sprintf(self::INTRODUCE_FORMAT, $this->name, $this->age, self::OCCUPATION);
    }

    public function greet(string $name): string
    {
        return sprintf(self::GREET_FORMAT, $name, $this->name);
    }

    public function advertise(): string
    {
        return self::ADVERTISE_FORMAT;
    }
}