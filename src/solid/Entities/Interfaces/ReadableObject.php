<?php

namespace solid\Entities\Interfaces;

interface ReadableObject
{
    public function setNumberOfPages(int $numberOfPages): void;

    public function getNumberOfPages(): int;

    public function setName(string $name): void;

    public function getName(): string;

    public function setDescription(string $description): void;

    public function getDescription(): string;
}