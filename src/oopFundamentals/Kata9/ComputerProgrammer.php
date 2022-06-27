<?php

namespace src\oopFundamentals\Kata9;

class ComputerProgrammer extends Person
{
    public const OCCUPATION = 'Computer Programmer';

    public const INTRODUCE_STRING = 'Hello, my name is %s, I am %d years old and I am a(n) %s';
    public const GREET_STRING = 'Hello %s, I\'m %s, nice to meet you';
    public const ADVERTISE_STRING = 'Don\'t forget to check out my coding projects';

    public function introduce(): string
    {
        return sprintf(self::INTRODUCE_STRING, $this->name, $this->age, self::OCCUPATION);
    }

    public function greet(string $name): string
    {
        return sprintf(self::GREET_STRING, $name, $this->name);
    }

    public function advertise(): string
    {
        return self::ADVERTISE_STRING;
    }
}