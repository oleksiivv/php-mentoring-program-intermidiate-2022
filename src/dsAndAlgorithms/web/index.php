<?php

use dsAndAlgorithms\ArrayRotation;
use dsAndAlgorithms\HourglassCalculation;
use dsAndAlgorithms\ListController;

if (isset($_GET['perform_rotate'])) {
    $rotatedArray = (new ArrayRotation())->perform(
        explode(' ', $_GET['array_for_rotation']),
        $_GET['rotation_step']
    );

    echo 'Input: ' . $_GET['array_for_rotation'] . '<br/>';
    echo 'Step: ' . $_GET['rotation_step'] . '<br/>';
    echo 'Output: ' . implode(' ', $rotatedArray) . '<br/>';
}

if (isset($_GET['perform_add_list_elements'])) {
    $elements = explode(' ', $_GET['list_elements']);
    $listController = new ListController();

    foreach ($elements as $element) {
        $listController->addElementAtBeginning($element);
    }

    echo 'Input: ' . $_GET['list_elements'] . '<br/>';
    echo 'Output: ' . implode(' ', $listController->toArray()) . '<br/>';
}

if (isset($_GET['perform_hourglass_calculation'])) {
    $elements = explode('|', $_GET['hourglass_input']);
    $elementsFormatted = [];

    foreach ($elements as $element) {
        $elementsFormatted[] = explode(' ', $element);
    }

    $hourglassCalculation = new HourglassCalculation($elementsFormatted);

    $hourglassSums = $hourglassCalculation->getHourglassesSums();
    $maxHourglassSum = $hourglassCalculation->getMaxHourglassSum();

    echo 'Input: ' . json_encode($elements) . '<br/>';
    echo 'Sums:' . json_encode($hourglassSums) . '<br/>';
    echo 'Max sum: ' . $maxHourglassSum . '<br/>';
}
?>
<!doctype html>
<html>
<head>
    <title>DS and algorithms</title>
</head>
<body>
<form method="GET" action="">
    <h3>Rotate array</h3>
    <input name="array_for_rotation" type="text" placeholder="1 2 45 78 22"/>
    <br/>
    <input name="rotation_step" type="number" placeholder="Step: "/>
    <br/>
    <input name="perform_rotate" type="submit" value="Rotate"/>
</form>

<form method="GET" action="">
    <h3>Unshift list elements</h3>
    <input name="list_elements" type="text" placeholder="1 25 36 4 15"/>
    <br/>
    <input name="perform_add_list_elements" type="submit" value="Add"/>
</form>

<form method="GET" action="">
    <h3>Hourglass calculation</h3>
    <textarea name="hourglass_input" placeholder="1 1 2|2 5 4|1 2 3"></textarea>
    <br/>
    <input name="perform_hourglass_calculation" type="submit" value="Calculate"/>
</form>
</body>
</html>