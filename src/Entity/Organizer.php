<?php

namespace Habitissimo\Kata\Entity;

/**
 * Class Organizer
 * @package Habitissimo\Kata\Entity
 */
class Organizer
{
    private Backpacker $backpacker;
    private array $items;

    public function __construct(Backpacker $backpacker)
    {
        $this->backpacker = $backpacker;
        $this->items = [];
    }

    public function organize(): void
    {
        $this->getAllItems();
        $this->sort();
        $this->putItemsIntoBags();
        $this->relocateRestItems();
    }

    private function getAllItems(): void
    {
        $this->items = $this->backpacker->getBackpack()->getItems();
        $this->backpacker->getBackpack()->setItems();
        if (!empty($this->backpacker->getBags())) {
            for ($i = 0; $i < count($this->backpacker->getBags()); $i++) {
                for ($j = 0; $j < count($this->backpacker->getBags()[$i]->getItems()); $j++) {
                    array_push($this->items, $this->backpacker->getBags()[$i]->getItems()[$j]);
                }
                $this->backpacker->getBags()[$i]->setItems();
            }
        }
    }

    private function sort(): void
    {
        usort($this->items, function (Item $a, Item $b) {
            return strnatcmp($a->getName(), $b->getName());
        });
    }

    private function putItemsIntoBags(): void
    {
        if (!empty($this->backpacker->getBags())) {
            for ($i = 0; $i < count($this->backpacker->getBags()); $i++) {
                if (!$this->backpacker->getBags()[$i]->isFull()) {
                    $this->items = $this->putItemIntoBag($this->backpacker->getBags()[$i]);
                }
            }
        }
    }

    private function putItemIntoBag(Bag $bag): array
    {
        $restItems = [];
        for ($i = 0; $i < count($this->items); $i++) {
            if (Util::checkEqualCategories($this->items[$i]->getCategory(), $bag->getCategory()) &&
                !$bag->isFull()) {
                $bag->addItem($this->items[$i]);
            } else {
                array_push($restItems, $this->items[$i]);
            }
        }

        return $restItems;
    }

    private function relocateRestItems(): void
    {
        for ($i = 0; $i < count($this->items); $i++) {
            $this->backpacker->takeAnotherItem($this->items[$i]);
        }
    }
}
