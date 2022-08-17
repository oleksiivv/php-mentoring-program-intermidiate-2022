<?php

namespace Patterns\ObserverPattern\Subscribers;

class NumberCounterSubscriber implements TextProcessorSubscriberInterface
{
    public function processText(string $data): array
    {
        return [
            'numbers count' => count(array_filter(explode(' ', $data),'is_numeric')),
        ];
    }
}