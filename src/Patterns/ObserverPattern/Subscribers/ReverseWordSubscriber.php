<?php

namespace Patterns\ObserverPattern\Subscribers;

class ReverseWordSubscriber implements TextProcessorSubscriberInterface
{
    public string $textWithReversedWords;

    public function processText(string $data): array
    {
        $words = explode(' ', $data);

        $this->textWithReversedWords = implode(' ', array_map(function ($word){
            return strrev($word);
        }, $words));

        return [
            'text with reversed words' => $this->textWithReversedWords,
        ];
    }

    public function getTextWithReversedWords(): string
    {
        return $this->textWithReversedWords;
    }
}