<?php

namespace Habitissimo\Kata\Entity;

/**
 * Class Category
 * @package Habitissimo\Kata\Entity
 */
class Category
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
