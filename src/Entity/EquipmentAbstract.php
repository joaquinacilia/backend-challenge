<?php

namespace Habitissimo\Kata\Entity;

use Exception;

/**
 * Class EquipmentAbstract.
 */
abstract class EquipmentAbstract implements EquipmentInterface
{
    private array $items;

    public function __construct(array $items = [])
    {
        $this->setItems($items);
    }

    public function setItems(array $items = []): void
    {
        $this->items = $items;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function addItem(Item $item): void
    {
        if ($this->isFull()) {
            throw new Exception('Maximum capacity exceeded');
        }

        array_push($this->items, $item);
    }

    public function isFull(): bool
    {
        return count($this->getItems()) == $this->getCapacity();
    }

    abstract public function getCapacity(): int;
}
