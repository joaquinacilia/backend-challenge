<?php

namespace Habitissimo\Kata\Entity;
use Exception;

/**
 * Class Backpack
 * @package Habitissimo\Kata\Entity
 */
class Backpack extends EquipmentAbstract
{
    const MAX_CAPACITY = 8;

    public function getCapacity(): int
    {
        return self::MAX_CAPACITY;
    }
}
