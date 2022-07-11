<?php

require_once __DIR__ . './../../../config/bootstrap.php';

use db\Services\HttpService;
use db\Repositories\ArticleRepository;

$articleRepository = new ArticleRepository($entityManager);
$httpService = new HttpService();

if (isset($_POST['create'])) {
    $articleRepository->create([
        'title' => $_POST['new-article-title'],
        'description' => $_POST['new-article-description'],
    ]);
}

if (isset($_POST['update'])) {
    $articleRepository->update(
            $_POST['update-article-id'],
            [
                'title' => $_POST['update-article-title'],
                'description' => $_POST['update-article-description'],
            ],
    );

    unset($_GET['update']);
}

if (isset($_GET['delete'])) {
    $articleRepository->delete($_GET['delete']);

    unset($_GET['delete']);
}

$searchCriteria = [];

if (isset($_GET['search'])) {
    $searchCriteria = ['title' => $_GET['search-title']];
}

$articles = $articleRepository->index(
        isset($_GET['page'])
            ? ($_GET['page'] - 1) * ArticleRepository::PAGINATION_ITEMS_PER_PAGE
            : 0,
        ArticleRepository::PAGINATION_ITEMS_PER_PAGE,
        $_GET['order'] ?? [],
        $searchCriteria,
);

$totalNumberOfArticles = $articleRepository->getNumberOfRecords($searchCriteria);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Articles</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<main role="main" class="container">
    <br/>
    <div class="row">
        <div class="col-sm-3">
            <h4>Create new article</h4>
            <form action="" method="POST">
                <input name="new-article-title" type="text" placeholder="Title: " class="form-control"/>
                <input name="new-article-description" type="text" placeholder="Description: " class="form-control"/>

                <input type="submit" name="create" class="btn btn-success" value="Create"/>
            </form>
        </div>
        <?php
            if (isset($_GET['update'])) :
                ?>
                <div class="col-sm-3">
                    <h4>Update article #<?= $_GET['update']['id'] ?></h4>
                    <form action="" method="POST">
                        <input name="update-article-id" value="<?= $_GET['update']['id'] ?>" class="form-control" readonly/>
                        <input name="update-article-title" value="<?= $_GET['update']['title'] ?>" type="text" placeholder="Title: " class="form-control"/>
                        <input name="update-article-description" value="<?= $_GET['update']['description'] ?>" type="text" placeholder="Description: " class="form-control"/>

                        <input type="submit" name="update" class="btn btn-warning" value="Update"/>
                    </form>
                </div>
        <?php endif; ?>
    </div>
    <br/>
    <h4>Search by title</h4>
    <form action="" method="GET">
        <input name="search-title" type="text" placeholder="Title: " value="<?= $_GET['search-title'] ?? '' ?>" class="form-control"/>

        <input type="submit" name="search" class="btn btn-primary" value="Submit"/>
    </form>
    <br/>
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><a href='<?= $httpService->addOrderParam('title') ?>'>Title</a></th>
            <th scope="col"><a href='<?= $httpService->addOrderParam('description') ?>'>Description</a></th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $last = (ArticleRepository::PAGINATION_ITEMS_PER_PAGE < count($articles))
            ? ArticleRepository::PAGINATION_ITEMS_PER_PAGE
            : count($articles);

        for ($i = 0; $i < $last; $i++):
            ?>
            <tr>
                <td><?= $articles[$i]->getTitle() ?></td>
                <td><?= $articles[$i]->getDescription() ?></td>
                <td><a href='<?= $httpService->addParamToURL('delete', $articles[$i]->getId()) ?>' class="btn btn-danger">Delete</a></td>
                <td><a href='<?= $httpService->addParamToURL('update', [
                        'id' => $articles[$i]->getId(),
                        'title' => $articles[$i]->getTitle(),
                        'description' => $articles[$i]->getDescription(),
                    ]) ?>' class="btn btn-warning">Update</a>
                </td>
            </tr>
        <?php endfor; ?>

        </tbody>
    </table>

    <nav aria-label="Navigation">
        <ul class="pagination justify-content-center">

            <?php
            $countOfPages = ceil($totalNumberOfArticles / ArticleRepository::PAGINATION_ITEMS_PER_PAGE);

            $firstShowedPage = $_GET['page'] ?? 1;
            $firstShowedPage = ($firstShowedPage - ArticleRepository::PAGINATION_NAVBAR_OFFSET_FROM_CURRENT_PAGE > 0)
                ? $firstShowedPage - ArticleRepository::PAGINATION_NAVBAR_OFFSET_FROM_CURRENT_PAGE
                : 1;

            $lastShowedPage = ($firstShowedPage + ArticleRepository::PAGINATION_ITEMS_PER_PAGE < $countOfPages)
                ? $firstShowedPage + ArticleRepository::PAGINATION_ITEMS_PER_PAGE
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