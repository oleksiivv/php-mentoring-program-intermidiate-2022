<?php

namespace src\oopFundamentals\Kata7;

class ComputerProgrammer extends Person
{
    public const INTRODUCE_FORMAT = 'Hello, my name is %s and I am a %s';

    public function introduce(): string
    {
        return sprintf(self::INTRODUCE_FORMAT, $this->name, $this->occupation);
    }
}