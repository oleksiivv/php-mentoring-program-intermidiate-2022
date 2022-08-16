<?php

require_once '../../../vendor/autoload.php';

use Patterns\StrategyPattern\EmployeeCollection;
use Patterns\StrategyPattern\Strategies\DepartmentNameSortStrategy;
use Patterns\StrategyPattern\Strategies\EmployeeNameSortStrategy;
use Patterns\StrategyPattern\Strategies\EmployeeSalarySortStrategy;
use Patterns\StrategyPattern\Strategies\SortStrategyInterface;

$employees = require_once 'employees.php';

$employeeCollection = new EmployeeCollection();

foreach ($employees as $employee) {
    $employeeCollection->addItem($employee);
}

$employeeCollection->setSortStrategy(new EmployeeNameSortStrategy());
$employeesSortedByName = $employeeCollection->sort(SortStrategyInterface::ASCENDING_DIRECTION);

$employeeCollection->setSortStrategy(new EmployeeSalarySortStrategy());
$employeesSortedBySalary = $employeeCollection->sort(SortStrategyInterface::ASCENDING_DIRECTION);

$employeeCollection->setSortStrategy(new DepartmentNameSortStrategy());
$employeesSortedByDepartmentName = $employeeCollection->sort(SortStrategyInterface::ASCENDING_DIRECTION);
?>
<!doctype html>
<html>
<head>
    <title>Strategy pattern</title>
    <style>
        table, th, td {
            border:1px solid black;
        }
    </style>
</head>
<body>
<div>
    <h1>Sorted by name</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Salary</th>
            <th scope="col">Department</th>
        </tr>
        </thead>
        <tbody>

        <?php
        foreach($employeesSortedByName as $employee):
            ?>
            <tr>
                <td><?= $employee->getName() ?></td>
                <td><?= $employee->getSalary() ?></td>
                <td><?= $employee->getDepartment()->getName() ?></td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
</div>
<div>
    <h1>Sorted by salary</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Salary</th>
            <th scope="col">Department</th>
        </tr>
        </thead>
        <tbody>

        <?php
        foreach($employeesSortedBySalary as $employee):
            ?>
            <tr>
                <td><?= $employee->getName() ?></td>
                <td><?= $employee->getSalary() ?></td>
                <td><?= $employee->getDepartment()->getName() ?></td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
</div>
<div>
    <h1>Sorted by department</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Salary</th>
            <th scope="col">Department</th>
        </tr>
        </thead>
        <tbody>

        <?php
        foreach($employeesSortedByDepartmentName as $employee):
            ?>
            <tr>
                <td><?= $employee->getName() ?></td>
                <td><?= $employee->getSalary() ?></td>
                <td><?= $employee->getDepartment()->getName() ?></td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
</div>
</body>
</html>