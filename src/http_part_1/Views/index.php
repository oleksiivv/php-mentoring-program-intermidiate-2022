<?php

require_once __DIR__ . './../../../config/bootstrap.php';

use http_part_1\Services\HttpService;
use http_part_1\Repositories\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$articleRepository = new ArticleRepository($entityManager);
$httpService = new HttpService();

$searchCriteria = [];

if ($request->get('search') !== null) {
    $searchCriteria = ['title' => $request->get('search-title')];
}

$articles = $articleRepository->index(
        $request->get('page') !== null
            ? ($request->get('page') - 1) * ArticleRepository::PAGINATION_ITEMS_PER_PAGE
            : 0,
        ArticleRepository::PAGINATION_ITEMS_PER_PAGE,
    $request->get('order') ?? [],
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
            <form action="Actions/createArticle.php" method="POST">
                <input name="new-article-title" type="text" placeholder="Title: " class="form-control"/>
                <input name="new-article-description" type="text" placeholder="Description: " class="form-control"/>

                <input type="submit" name="create" class="btn btn-success" value="Create"/>
            </form>
        </div>
        <?php
        if ($request->get('update') !== null) :
            ?>
            <div class="col-sm-3">
                <h4>Update article #<?= $request->get('update')['id'] ?></h4>
                <form action="Actions/updateArticle.php" method="POST">
                    <input name="update-article-id" value="<?= $request->get('update')['id'] ?>" class="form-control" readonly/>
                    <input name="update-article-title" value="<?= $request->get('update')['title'] ?>" type="text" placeholder="Title: " class="form-control"/>
                    <input name="update-article-description" value="<?= $request->get('update')['description'] ?>" type="text" placeholder="Description: " class="form-control"/>

                    <input type="submit" name="update" class="btn btn-warning" value="Update"/>
                </form>
            </div>
        <?php endif; ?>
    </div>
    <br/>
    <h4>Search by title</h4>
    <form action="" method="GET">
        <input name="search-title" type="text" placeholder="Title: " value="<?= $request->get('search-title') ?? '' ?>" class="form-control"/>

        <input type="submit" name="search" class="btn btn-primary" value="Submit"/>
    </form>
    <br/>
    <nav aria-label="Navigation">
        <ul class="pagination justify-content-center">

            <?php
            $countOfPages = ceil($totalNumberOfArticles / ArticleRepository::PAGINATION_ITEMS_PER_PAGE);

            $firstShowedPage = $request->get('page') ?? 1;
            $firstShowedPage = ($firstShowedPage - ArticleRepository::PAGINATION_NAVBAR_OFFSET_FROM_CURRENT_PAGE > 0)
                ? $firstShowedPage - ArticleRepository::PAGINATION_NAVBAR_OFFSET_FROM_CURRENT_PAGE
                : 1;

            $lastShowedPage = ($firstShowedPage + ArticleRepository::PAGINATION_ITEMS_PER_PAGE < $countOfPages)
                ? $firstShowedPage + ArticleRepository::PAGINATION_ITEMS_PER_PAGE
                : $countOfPages + 1;

            $currentPage = $request->get('page') ?? 1;

            for ($i = $firstShowedPage; $i < $lastShowedPage; $i++):
                ?>
                <li class="page-item <?= $currentPage == $i ? 'active' : '' ?> ">
                    <a class="page-link" href='<?= $httpService->addParamToURL(Request::createFromGlobals(), 'page', $i) ?>'>
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor; ?>

        </ul>
    </nav>
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><a href='<?= $httpService->addOrderParam(Request::createFromGlobals(), 'title') ?>'>Title</a></th>
            <th scope="col"><a href='<?= $httpService->addOrderParam(Request::createFromGlobals(), 'description') ?>'>Description</a></th>
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
                <td>
                    <form action="Actions/deleteArticle.php" method="POST">
                        <input name="delete-article-id" value="<?= $articles[$i]->getId() ?>" class="form-control" hidden/>

                        <input type="submit" name="delete" class="btn btn-danger" value="Delete"/>
                    </form>
                </td>
                <td><a href='<?= $httpService->addParamToURL(Request::createFromGlobals(), 'update', [
                        'id' => $articles[$i]->getId(),
                        'title' => $articles[$i]->getTitle(),
                        'description' => $articles[$i]->getDescription(),
                    ]) ?>' class="btn btn-warning">Update</a>
                </td>
            </tr>
        <?php endfor; ?>

        </tbody>
    </table>

</main>
</html>