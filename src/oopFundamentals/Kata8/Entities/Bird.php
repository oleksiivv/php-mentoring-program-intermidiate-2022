<?php

namespace src\oopFundamentals\Kata8\Entities;

use src\oopFundamentals\Kata8\CanFly;

class Bird implements CanFly
{
    public function __construct(private string $name)
    {
    }

    public function fly(): string
    {
        return 'I am flying';
    }

    public function chirp(): string
    {
        return 'Chirp chirp';
    }
}