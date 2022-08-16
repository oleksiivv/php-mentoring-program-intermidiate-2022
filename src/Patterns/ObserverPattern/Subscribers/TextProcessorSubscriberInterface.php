<?php

namespace Patterns\ObserverPattern\Subscribers;

interface TextProcessorSubscriberInterface
{
    public function processText(string $data): array;
}