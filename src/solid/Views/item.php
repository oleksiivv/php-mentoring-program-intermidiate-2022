<?php

require_once __DIR__ . './../../../config/bootstrap.php';

use db\Services\HttpService;
use solid\Entities\Book;
use solid\Repositories\Interfaces\ReadableObjectRepositoryInterface;
use solid\Services\RepositoriesManagementService;

$entity = $_POST['entity'];
$itemId = $_POST['id'];

$repository = (new RepositoriesManagementService($entityManager))->getRepository($entity);

$item = $repository->find($itemId);

$data = $item->toArray();

?>
<html>
<head>
    <title><?= $item->getName() ?></title>
</head>
<body>
<ul>
    <?php
    foreach ($data as $key=>$value):
    ?>
        <li><?= $key . ': ' .  (is_bool($value)
                    ? ($value ? 'yes' : 'no')
                    : $value)
            ?></li>
    <?php endforeach; ?>
</ul>
<?php
if ($item->isExportable()) :
?>
    <form method="POST" action="actions/exportItem.php">
        <input name="entity" value="<?= $entity ?>" hidden/>
        <input name="id" value="<?= $itemId ?>" hidden/>

        <input type="submit" name="Export" value="Export"/>
    </form>
<?php endif; ?>
</body>
</html>
