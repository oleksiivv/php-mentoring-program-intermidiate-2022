<?php

require_once __DIR__ . './../../../config/bootstrap.php';

use db\Services\HttpService;
use solid\Entities\Magazine;
use solid\Repositories\Interfaces\ReadableObjectRepositoryInterface;
use solid\Services\RepositoriesManagementService;

$magazinesRepository = (new RepositoriesManagementService($entityManager))->getRepository(Magazine::class);
$httpService = new HttpService();

if (isset($_GET['delete'])) {
    $magazinesRepository->delete($_GET['delete']);

    unset($_GET['delete']);
}

$searchCriteria = [];

if (isset($_GET['search'])) {
    $searchCriteria = ['name' => $_GET['search-name']];
}

$books = $magazinesRepository->index(
        isset($_GET['page'])
            ? ($_GET['page'] - 1) * ReadableObjectRepositoryInterface::PAGINATION_ITEMS_PER_PAGE
            : 0,
        ReadableObjectRepositoryInterface::PAGINATION_ITEMS_PER_PAGE,
        $_GET['order'] ?? [],
        $searchCriteria,
);

$totalNumberOfEntities = $magazinesRepository->getNumberOfRecords($searchCriteria);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Books</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<main role="main" class="container">
    <br/>
    <center><h1>Magazines</h1></center>
    <div class="row">
        <div class="col-sm-3">
            <h4>Create new book</h4>
            <form action="actions/createOrUpdate.php" method="POST">
                <input name="entity" value="<?= Magazine::class ?>" hidden/>
                <input name="name" type="text" placeholder="Name: " class="form-control"/>
                <input name="description" type="text" placeholder="Description: " class="form-control"/>
                Has hard cover: <input name="hardCover" type="checkbox" />
                <input name="numberOfPages" type="number" placeholder="Number of pages: " class="form-control"/>

                <input type="submit" name="create" class="btn btn-success" value="Create"/>
            </form>
        </div>
        <?php
            if (isset($_GET['update'])) :
                ?>
                <div class="col-sm-3">
                    <h4>Update book #<?= $_GET['update']['id'] ?></h4>
                    <form action="actions/createOrUpdate.php" method="POST">
                        <input name="update-entity-id" value="<?= $_GET['update']['id'] ?>" class="form-control" readonly/>
                        
                        <input name="entity" value="<?= Magazine::class ?>" hidden/>
                        <input name="name" type="text" value="<?= $_GET['update']['name'] ?>" placeholder="Name: " class="form-control"/>
                        <input name="description" type="text" value="<?= $_GET['update']['description'] ?>" placeholder="Description: " class="form-control"/>
                        <input name="numberOfPages" type="number" value="<?= $_GET['update']['numberOfPages'] ?>" placeholder="Number of pages: " class="form-control"/>
                        Has hard cover: <input name="hardCover" type="checkbox" value="<?= $_GET['update']['hardCover']  == 1 ? 1 : 0 ?>"/>

                        <input type="submit" name="update" class="btn btn-warning" value="Update"/>
                    </form>
                </div>
        <?php endif; ?>
    </div>
    <br/>
    <h4>Search by title</h4>
    <form action="" method="GET">
        <input name="search-name" type="text" placeholder="Title: " value="<?= $_GET['search-name'] ?? '' ?>" class="form-control"/>

        <input type="submit" name="search" class="btn btn-primary" value="Submit"/>
    </form>
    <br/>
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><a href='<?= $httpService->addOrderParam('name') ?>'>Name</a></th>
            <th scope="col"><a href='<?= $httpService->addOrderParam('description') ?>'>Description</a></th>
            <th scope="col"><a href='<?= $httpService->addOrderParam('hardCover') ?>'>Hard cover</a></th>
            <th scope="col"><a href='<?= $httpService->addOrderParam('numberOfPages') ?>'>Number of pages</a></th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $last = (ReadableObjectRepositoryInterface::PAGINATION_ITEMS_PER_PAGE < count($books))
            ? ReadableObjectRepositoryInterface::PAGINATION_ITEMS_PER_PAGE
            : count($books);

        for ($i = 0; $i < $last; $i++):
            ?>
            <tr>
                <td><?= $books[$i]->getName() ?></td>
                <td><?= $books[$i]->getDescription() ?></td>
                <td><?= $books[$i]->getHardCover() == 1 ? 'yes' : 'no' ?></td>
                <td><?= $books[$i]->getNumberOfPages() ?></td>
                <td>
                    <a href='<?= $httpService->addParamToURL('delete', $books[$i]->getId()) ?>' class="btn btn-danger">Delete</a>
                    <br/>
                    <a href='<?= $httpService->addParamToURL('update', $books[$i]->toArray()) ?>' class="btn btn-warning">Update</a>
                    <br/>

                    <form method="post" action="item.php">
                        <input name="entity" value="<?= Magazine::class ?>" hidden/>
                        <input name="id" value="<?= $books[$i]->getId() ?>" hidden/>
                        <input name="details" type="submit" class="btn btn-primary" value="Details"/>
                    </form>
                </td>
            </tr>
        <?php endfor; ?>

        </tbody>
    </table>

    <nav aria-label="Navigation">
        <ul class="pagination justify-content-center">

            <?php
            $countOfPages = ceil($totalNumberOfEntities / ReadableObjectRepositoryInterface::PAGINATION_ITEMS_PER_PAGE);

            $firstShowedPage = $_GET['page'] ?? 1;
            $firstShowedPage = ($firstShowedPage - ReadableObjectRepositoryInterface::PAGINATION_NAVBAR_OFFSET_FROM_CURRENT_PAGE > 0)
                ? $firstShowedPage - ReadableObjectRepositoryInterface::PAGINATION_NAVBAR_OFFSET_FROM_CURRENT_PAGE
                : 1;

            $lastShowedPage = ($firstShowedPage + ReadableObjectRepositoryInterface::PAGINATION_ITEMS_PER_PAGE < $countOfPages)
                ? $firstShowedPage + ReadableObjectRepositoryInterface::PAGINATION_ITEMS_PER_PAGE
                : $countOfPages + 1;

            $currentPage = $_GET['page'] ?? 1;

            for ($i = $firstShowedPage; $i < $lastShowedPage; $i++):
                ?>
                <li class="page-item <?= $currentPage == $i ? 'active' : '' ?> ">
                    <a class="page-link" href='<?= $httpService->addParamToURL('page', $i) ?>'>
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor; ?>

        </ul>
    </nav>
</main>
</html>