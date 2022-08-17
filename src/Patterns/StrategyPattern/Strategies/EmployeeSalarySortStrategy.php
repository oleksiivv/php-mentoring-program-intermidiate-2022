<?php

namespace Patterns\StrategyPattern\Strategies;

class EmployeeSalarySortStrategy implements SortStrategyInterface
{
    public function sort(array $employees, string $direction): array
    {
        usort($employees, function ($a, $b) use ($direction) {
            return $direction === SortStrategyInterface::ASCENDING_DIRECTION
                ? $a->getSalary() > $b->getSalary()
                : $a->getSalary() < $b->getSalary();
        });

        return $employees;
    }
}