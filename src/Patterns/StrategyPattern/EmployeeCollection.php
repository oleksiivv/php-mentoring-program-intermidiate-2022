<?php

namespace Patterns\StrategyPattern;

use Patterns\StrategyPattern\Strategies\SortStrategyInterface;

class EmployeeCollection
{
    private array $employees;

    private SortStrategyInterface $sortStrategy;

    public function __construct()
    {
        $this->employees = [];
    }

    public function addItem(array $data): void
    {
        $employee = new Employee();

        $employee->setName($data['name'])
            ->setDepartment((new Department())->setName($data['departmentName']))
            ->setSalary($data['salary']);

        $this->employees[] = $employee;
    }

    public function getEmployeeCollection(): array
    {
        return $this->employees;
    }

    public function setSortStrategy(SortStrategyInterface $sortStrategy): void
    {
        $this->sortStrategy = $sortStrategy;
    }

    public function sort(string $direction): array
    {
        return $this->sortStrategy->sort($this->employees, $direction);
    }
}