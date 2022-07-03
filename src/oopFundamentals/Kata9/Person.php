<?php

namespace src\oopFundamentals\Kata9;

abstract class Person
{
    public const GENDER_MALE = 'male';
    public const GENDER_FEMALE = 'female';

    public int $age;

    public string $name;

    public string $gender;

    public function __construct(int $age, string $name, string $gender)
    {
        $this->age = $age;
        $this->name = $name;
        $this->gender = $gender;
    }

    abstract public function introduce(): string;

    abstract public function greet(string $name);
}