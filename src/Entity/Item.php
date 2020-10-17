<?php

namespace Habitissimo\Kata\Entity;

/**
 * Class Item
 * @package Habitissimo\Kata\Entity
 */
class Item
{
    private string $name;
    private Category $category;

    public function __construct(string $name, Category $category)
    {
        $this->name     = $name;
        $this->category = $category;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }
}
