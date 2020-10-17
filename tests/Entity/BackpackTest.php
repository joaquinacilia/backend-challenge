<?php

namespace Habitissimo\Kata\Tests\Entity;

use PHPUnit\Framework\TestCase;
use Habitissimo\Kata\Entity\Item;
use Habitissimo\Kata\Entity\Backpack;
use Habitissimo\Kata\Entity\Category;

/**
 * Class BackpackTest
 * @package Habitissimo\Kata\Tests\Entity
 */
class BackpackTest extends TestCase
{
    /** @var Backpack */
    protected $backpack;

    protected function setUp(): void
    {
        $this->backpack = new Backpack();
    }

    /**
     * @testdox When the object is instantiated, the backpack is empty
     */
    public function testCreateNewBackpack(): void
    {
        $this->assertEmpty($this->backpack->getItems());
    }

    /**
     * @testdox Put a new item in the backpack
     */
    public function testAddItemIntoBackpack(): void
    {
        $category = new Category('Clothes');
        $item = new Item('Leather', $category);

        $this->backpack->addItem($item);

        $this->assertEquals('Leather', $this->backpack->getItems()[0]->getName());
        $this->assertEquals('Clothes', $this->backpack->getItems()[0]->getCategory()->getName());
    }

    /**
     * * @testdox Cannot exceed maximum capacity of the backpack
     */
    public function testBackpackMaxCapacity(): void
    {
        $category = new Category('Clothes');
        $item = new Item('Leather', $category);

        $this->expectErrorMessage('Maximum capacity exceeded');

        for ($i = 0; $i < ($this->backpack->getCapacity() + 1); $i++) {
            $this->backpack->addItem($item);
        }
    }
}
