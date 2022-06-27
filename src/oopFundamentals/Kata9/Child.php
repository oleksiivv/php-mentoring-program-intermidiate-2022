<?php

namespace src\oopFundamentals\Kata9;

final class Child extends Person
{
    public const INTRODUCE_STRING = 'Hi, I\'m %s and I am %d years old';
    public const GREET_STRING = 'Hi %s, let\'s play!';
    public const DREAMS_STRING = 'I would like to be a(n) %s when I grow up.';

    public array $aspirations;

    public function __construct(int $age, string $name, string $gender, array $aspirations)
    {
        $this->aspirations = $aspirations;

        parent::__construct($age, $name, $gender);
    }

    public function introduce(): string
    {
        return sprintf(self::INTRODUCE_STRING, $this->name, $this->age);
    }

    public function greet(string $name): string
    {
        return sprintf(self::GREET_STRING, $name);
    }

    public function sayDreams(): string
    {
        return sprintf(self::DREAMS_STRING, implode(', ', $this->aspirations));
    }
}