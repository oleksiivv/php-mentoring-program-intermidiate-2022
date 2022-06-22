<?php

namespace src\dsAndAlgorithms;

use SplDoublyLinkedList;

class ListController
{
    private SplDoublyLinkedList $splDoublyLinkedList;

    public function __construct()
    {
        $this->splDoublyLinkedList = new SplDoublyLinkedList();
    }

    public function addElementAtBegin($element): SplDoublyLinkedList
    {
        $this->splDoublyLinkedList->unshift($element);

        return $this->splDoublyLinkedList;
    }

    public function toArray(): array
    {
        $result = [];

        $this->splDoublyLinkedList->setIteratorMode(SplDoublyLinkedList::IT_MODE_FIFO);
        for ($this->splDoublyLinkedList->rewind(); $this->splDoublyLinkedList->valid(); $this->splDoublyLinkedList->next()) {
            $result[] = $this->splDoublyLinkedList->current();
        }

        return $result;
    }
}