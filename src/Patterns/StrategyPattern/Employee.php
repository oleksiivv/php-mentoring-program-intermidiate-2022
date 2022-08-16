<?php

namespace Patterns\StrategyPattern;

class Employee
{
    private string $name;

    private float $salary;

    private Department $department;

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setSalary(float $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    public function getSalary(): float
    {
        return $this->salary;
    }

    public function setDepartment(Department $department): self
    {
        $this->department = $department;

        return $this;
    }

    public function getDepartment(): Department
    {
        return $this->department;
    }
}