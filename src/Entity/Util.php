<?php

namespace Habitissimo\Kata\Entity;

/**
 * Class Util
 * @package Habitissimo\Kata\Entity
 */
class Util
{
    public static function checkEqualCategories(Category $category1, ?Category $category2): bool
    {
        return $category1 === $category2;
    }
}
