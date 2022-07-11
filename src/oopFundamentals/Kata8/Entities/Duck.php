<?php

namespace oopFundamentals\Kata8\Entities;

use oopFundamentals\Kata8\CanSwim;

class Duck extends Bird implements CanSwim
{
    public function __construct(private string $name)
    {
    }

    public function chirp(): string
    {
        return 'Quack quack';
    }

    public function swim(): string
    {
        return 'Splash! I\'m swimming';
    }
}