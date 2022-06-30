<?php

namespace src\oopFundamentals\Kata6;

class Person
{
    public const SPECIES = 'Homo Sapiens';

    public const AGE_VALIDATION_ERROR_MESSAGE = 'Age must be a non-negative integer!';

    public const OCCUPATION_VALIDATION_ERROR = 'Occupation must be a string!';

    public const NAME_VALIDATION_ERROR = 'Name must be a string!';

    public function __construct(
        protected $age,
        protected $name,
        protected $occupation,
    ) {
        $this->validateAge()
            ->validateName()
            ->validateOccupation();
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

    public function setAge($age): self
    {
        $this->validateAge();

        $this->age = $age;

        return $this;
    }

    public function setName($name): self
    {
        $this->validateName();

        $this->name = $name;

        return $this;
    }

    public function setOccupation($occupation): self
    {
        $this->validateOccupation();

        $this->occupation = $occupation;

        return $this;
    }

    private function validateAge(): self
    {
        if (!is_int($this->age) || $this->age < 0) {
            throw new \InvalidArgumentException(self::AGE_VALIDATION_ERROR_MESSAGE);
        }

        return $this;
    }

    private function validateName(): self
    {
        if (!is_string($this->name)) {
            throw new \InvalidArgumentException(self::NAME_VALIDATION_ERROR);
        }

        return $this;
    }

    private function validateOccupation(): self
    {
        if (!is_string($this->occupation)) {
            throw new \InvalidArgumentException(self::OCCUPATION_VALIDATION_ERROR);
        }

        return $this;
    }
}