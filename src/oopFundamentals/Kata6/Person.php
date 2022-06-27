<?php

namespace src\oopFundamentals\Kata6;

class Person
{
    public const SPECIES = 'Homo Sapiens';

    public const AGE_VALIDATION_ERROR_MESSAGE = 'Age must be a non-negative integer!';

    public const OCCUPATION_VALIDATION_ERROR = 'Occupation must be a string!';

    public function __construct(
        protected int $age,
        protected string $name,
        protected $occupation,
    ) {
        if ($this->age < 0) {
            throw new \InvalidArgumentException(self::AGE_VALIDATION_ERROR_MESSAGE);
        }

        if (gettype($this->occupation) !== 'string') {
            throw new \InvalidArgumentException(self::OCCUPATION_VALIDATION_ERROR);
        }
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOccupation(): string
    {
        return $this->occupation;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setOccupation(string $occupation): self
    {
        $this->occupation = $occupation;

        return $this;
    }
}