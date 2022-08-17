<?php

use Patterns\ObserverPattern\Publisher\TextScannerPublisher;
use Patterns\ObserverPattern\Subscribers\LongestWordKeeperSubscriber;
use Patterns\ObserverPattern\Subscribers\NumberCounterSubscriber;
use Patterns\ObserverPattern\Subscribers\ReverseWordSubscriber;
use Patterns\ObserverPattern\Subscribers\WordCounterSubscriber;

require_once '../../../vendor/autoload.php';

$publisher = new TextScannerPublisher();

$longestWordKeeperSubscriber = new LongestWordKeeperSubscriber();
$reverseWordSubscriber = new ReverseWordSubscriber();

$publisher->subscribe($longestWordKeeperSubscriber);
$publisher->subscribe($reverseWordSubscriber);

$publisher->subscribe(new NumberCounterSubscriber());
$publisher->subscribe(new ReverseWordSubscriber());
$publisher->subscribe(new WordCounterSubscriber());

$result = $publisher->scanText(__DIR__ . '\text.txt');

foreach ($result as $key=>$value) {
    echo "$key: $value<br/>";
}

echo '<br/>';

echo 'Text: ' . $publisher->getText();
