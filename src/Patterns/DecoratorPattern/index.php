<?php

use Patterns\DecoratorPattern\Decorators\LowerCaseReadPersonDecorator;
use Patterns\DecoratorPattern\Decorators\PersonRepository;
use Patterns\DecoratorPattern\Decorators\UpperCaseWritePersonDecorator;
use Patterns\DecoratorPattern\Entities\Person;

require_once '../../../vendor/autoload.php';
require_once __DIR__ . './../../../config/bootstrap.php';

$personRepository = new PersonRepository($entityManager);

$lowerCaseReadPersonDecorator = new LowerCaseReadPersonDecorator($personRepository);
$upperCaseWritePersonDecorator = new UpperCaseWritePersonDecorator($personRepository);

if (isset($_POST['create-person'])) {
    $person = new Person();
    $person->setName($_POST['new-person-name']);

    $upperCaseWritePersonDecorator->savePerson($person);
}

if (isset($_GET['search-person'])) {
    $foundPerson = $lowerCaseReadPersonDecorator->readPerson($_GET['search-person-name']);

    echo 'Search result:';
    echo '<br/>ID: ' . $foundPerson->getId();
    echo '<br/>Name: ' . $foundPerson->getName();
}

$peoples = $lowerCaseReadPersonDecorator->readPeoples();
?>
<!doctype html>
<html>
<head>
    <title>Decorator pattern</title>
    <style>
        table, th, td {
            border:1px solid black;
        }
    </style>
</head>
<body>
<div>
    <h2>Search</h2>
    <form action="" method="GET">
        <input name="search-person-name" type="text" placeholder="Name: " class="form-control"/>

        <input type="submit" name="search-person" class="btn btn-success" value="Create"/>
    </form>
</div>

<div>
    <h2>Create</h2>
    <form action="" method="POST">
        <input name="new-person-name" type="text" placeholder="Name: " class="form-control"/>

        <input type="submit" name="create-person" class="btn btn-success" value="Create"/>
    </form>
</div>
<div>
    <h1>People</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
        </tr>
        </thead>
        <tbody>

        <?php
        foreach($peoples as $people):
            ?>
            <tr>
                <td><?= $people->getId() ?></td>
                <td><?= $people->getName() ?></td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
</div>
</body>
</html>