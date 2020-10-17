<?php

namespace Habitissimo\Kata\Entity;
use Exception;

/**
 * Class Bag
 * @package Habitissimo\Kata\Entity
 */
class Bag extends EquipmentAbstract
{
    const MAX_CAPACITY = 4;

    private ?Category $category;

    public function __construct(array $items = [], ?Category $category = null)
    {
        parent::__construct($items);
        $this->category = $category;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function getCapacity(): int
    {
        return self::MAX_CAPACITY;
    }
}
