<?php

namespace Habitissimo\Kata\Entity;
use Exception;

/**
 * Class Backpack
 * @package Habitissimo\Kata\Entity
 */
class Backpack
{
    const MAX_CAPACITY = 8;

    private array $items;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function addItem(Item $item): void
    {
        if (count($this->getItems()) == $this->getCapacity()) {
            throw new Exception('Maximum capacity exceeded');
        }

        array_push($this->items, $item);
    }

    public function getCapacity(): int
    {
        return self::MAX_CAPACITY;
    }
}
