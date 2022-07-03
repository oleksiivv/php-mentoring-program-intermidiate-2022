<?php

namespace src\oopFundamentals\Kata8\Entities;

use src\oopFundamentals\Kata8\CanClimb;

class Cat implements CanClimb
{
    public function meow(): string
    {
        return 'Meow meow';
    }

    public function play(string $name): string
    {
        return sprintf('Hey %s, let\'s play!', $name);
    }

    public function climb(): string
    {
        return 'Look, I\'m climbing a tree';
    }
}