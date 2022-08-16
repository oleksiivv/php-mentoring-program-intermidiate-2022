<?php

use Patterns\AdapterPattern\Adapter\IntegerStackDecorator;
use Patterns\AdapterPattern\ASCIIStack;
use Patterns\AdapterPattern\IntegerStack;

require_once '../../../vendor/autoload.php';

$integerStackAdapter = new IntegerStackDecorator(new IntegerStack());
$asciiStack = new ASCIIStack();

if (isset($_POST['push'])) {
    foreach (explode(' ', $_POST['push-integers']) as $value) {
        $integerStackAdapter->push($value);
        $asciiStack->push($value);
    }

    echo 'ASCII stack: ';
    while(! $asciiStack->splStack->isEmpty()){
        echo $asciiStack->pop() . ' ';
    }

    echo '<br/>';
    echo 'Integer stack: ';
    while(! $integerStackAdapter->integerStack->splStack->isEmpty()){
        echo $integerStackAdapter->pop() . ' ';
    }
}
?>
<!doctype html>
<html>
<head>
    <title>Adapter pattern</title>
    <style>
        table, th, td {
            border:1px solid black;
        }
    </style>
</head>
<body>
<div>
    <form action="" method="POST">
        <input name="push-integers" type="text" placeholder="12 2 4 6 1 9..." class="form-control"/>

        <input type="submit" name="push" class="btn btn-success" value="Push"/>
    </form>
</div>
</body>
</html>