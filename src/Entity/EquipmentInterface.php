<?php

namespace Habitissimo\Kata\Entity;

/**
 * Interface EquipmentInterface.
 */
interface EquipmentInterface
{
    public function getItems(): array;

    public function addItem(Item $item): void;

    public function isFull(): bool;

    public function getCapacity(): int;
}
