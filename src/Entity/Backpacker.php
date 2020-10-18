<?php

namespace Habitissimo\Kata\Entity;

use Exception;

/**
 * Class Backpacker.
 */
class Backpacker
{
    const MAX_BAGS = 4;

    private Backpack $backpack;
    private array $bags;

    public function __construct()
    {
        $this->backpack = new Backpack();
        $this->bags     = [];
    }

    public function getBackpack(): Backpack
    {
        return $this->backpack;
    }

    public function getBags(): array
    {
        return $this->bags;
    }

    public function addBag(Bag $bag): void
    {
        if ($this->isFull()) {
            throw new Exception('Maximum number of bags exceeded');
        }
        array_push($this->bags, $bag);
    }

    public function isFull(): bool
    {
        return count($this->getBags()) == $this->getMaxBags();
    }

    public function takeAnotherItem(Item $item): void
    {
        if (!$this->backpack->isFull()) {
            $this->backpack->addItem($item);
        } else {
            $i = 0;
            while ($i < count($this->bags)) {
                if (!$this->bags[$i]->isFull()) {
                    $this->bags[$i]->addItem($item);
                    break;
                }
                ++$i;
            }
        }
    }

    public function getMaxBags(): int
    {
        return self::MAX_BAGS;
    }
}
