<?php

namespace Habitissimo\Kata\Entity;

/**
 * Class Backpack.
 */
class Backpack extends EquipmentAbstract
{
    const MAX_CAPACITY = 8;

    public function getCapacity(): int
    {
        return self::MAX_CAPACITY;
    }
}
