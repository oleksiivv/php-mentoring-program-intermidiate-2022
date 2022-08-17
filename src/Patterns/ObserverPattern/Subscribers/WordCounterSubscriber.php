<?php

namespace Patterns\ObserverPattern\Subscribers;

class WordCounterSubscriber implements TextProcessorSubscriberInterface
{
    public function processText(string $data): array
    {
        return [
            'words count' => str_word_count($data),
        ];
    }
}