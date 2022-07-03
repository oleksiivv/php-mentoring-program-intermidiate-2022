<?php

namespace src\oopFundamentals\Kata8\Entities;

use src\oopFundamentals\Kata8\CanGreet;
use src\oopFundamentals\Kata8\CanSwim;

class Dog implements CanSwim, CanGreet
{

    public function greet(string $name): string
    {
        return sprintf('Hello %s, welcome to my home', $name);
    }

    public function swim(): string
    {
        return 'I\'m swimming, woof woof';
    }

    public function bark(): string
    {
        return 'Woof woof';
    }
}