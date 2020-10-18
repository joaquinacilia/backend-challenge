<?php

namespace Habitissimo\Kata\Entity;

/**
 * Class Util.
 */
class Util
{
    public static function checkEqualCategories(Category $category1, ?Category $category2): bool
    {
        return $category1 === $category2;
    }
}
