<?php

namespace Patterns\ObserverPattern\Subscribers;

class LongestWordKeeperSubscriber implements TextProcessorSubscriberInterface
{
    private string $longestWord;

    public function processText(string $data): array
    {
        $words = explode(' ', $data);

        usort($words, function($a, $b) {
            return strlen($b) - strlen($a);
        });

        $this->longestWord = $words[0];

        return [
            'longest word' => $this->longestWord,
        ];
    }

    public function getLongestWord(): string
    {
        return $this->longestWord;
    }
}