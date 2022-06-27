<?php

namespace src\oopFundamentals\Kata7;

class ComputerProgrammer extends Person
{
    public const INTRODUCE_STRING = 'Hello, my name is %s and I am a %s';

    public function introduce(): string
    {
        return sprintf(self::INTRODUCE_STRING, $this->name, $this->occupation);
    }
}