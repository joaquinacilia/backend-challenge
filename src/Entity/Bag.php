<?php

namespace Habitissimo\Kata\Entity;
use Exception;

/**
 * Class Bag
 * @package Habitissimo\Kata\Entity
 */
class Bag
{
    const MAX_CAPACITY = 4;

    private array $items;
    private ?Category $category;

    public function __construct(array $items = [], ?Category $category = null)
    {
        $this->items = $items;
        $this->category = $category;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
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
