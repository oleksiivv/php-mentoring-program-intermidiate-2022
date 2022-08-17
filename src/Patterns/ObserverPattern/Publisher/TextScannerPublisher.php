<?php

namespace Patterns\ObserverPattern\Publisher;

use Patterns\ObserverPattern\Subscribers\TextProcessorSubscriberInterface;

class TextScannerPublisher
{
    private array $subscribers;

    private string $text;

    public function subscribe(TextProcessorSubscriberInterface $subscriber): void
    {
        $this->subscribers[] = $subscriber;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function scanText(string $filename): array
    {
        $this->text = file_get_contents($filename);

        return $this->notifySubscribers($this->text);
    }

    private function notifySubscribers(string $data): array
    {
        $result = [];
        
        foreach ($this->subscribers as $subscriber) {
            $result = array_merge($result, $subscriber->processText($data));
        }

        return $result;
    }
}