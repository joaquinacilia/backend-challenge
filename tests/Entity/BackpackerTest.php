<?php

namespace Habitissimo\Kata\Tests\Entity;

use PHPUnit\Framework\TestCase;
use Habitissimo\Kata\Entity\Bag;
use Habitissimo\Kata\Entity\Item;
use Habitissimo\Kata\Entity\Backpack;
use Habitissimo\Kata\Entity\Category;
use Habitissimo\Kata\Entity\Backpacker;

/**
 * Class BackpackerTest.
 */
class BackpackerTest extends TestCase
{
    /** @var Backpacker */
    protected $backpacker;

    protected function setUp(): void
    {
        $this->backpacker = new Backpacker();
    }

    /**
     * @testdox When the object is instantiated, the backpacker has an empty backpack and no bags
     */
    public function testCreateNewBackpacker(): void
    {
        $this->assertEmpty($this->backpacker->getBags());
        $this->assertTrue($this->backpacker->getBackpack() instanceof Backpack);
        $this->assertEmpty($this->backpacker->getBackpack()->getItems());
    }

    /**
     * @testdox Add a new empty bag
     */
    public function testAddBag(): void
    {
        $category = new Category('Clothes');
        $bag      = new Bag([], $category);
        $this->backpacker->addBag($bag);

        $this->assertEquals(1, count($this->backpacker->getBags()));
        $this->assertEquals('Clothes', $this->backpacker->getBags()[0]->getCategory()->getName());
    }

    /**
     * @testdox Backpack is empty, put the item in it
     */
    public function testTakeOneItemIntoEmptyBackpack(): void
    {
        $category = new Category('Clothes');
        $item     = new Item('Leather', $category);

        $this->backpacker->takeAnotherItem($item);

        $this->assertEquals(1, count($this->backpacker->getBackpack()->getItems()));
        $this->assertEquals('Leather', $this->backpacker->getBackpack()->getItems()[0]->getName());
        $this->assertEquals('Clothes', $this->backpacker->getBackpack()->getItems()[0]->getCategory()->getName());
    }

    /**
     * @testdox Backpack is full, put the item in the next available bag
     */
    public function testTakeOneItemIntoNextAvailableBagWhenBackpackIsFull(): void
    {
        $category = new Category('Clothes');
        $item     = new Item('Leather', $category);
        $limit    = $this->backpacker->getBackpack()->getCapacity() + 1;

        $i = 0;
        while ($i < $limit) {
            if ($i == $this->backpacker->getBackpack()->getCapacity()) {
                $this->backpacker->addBag(new Bag());
            }
            $this->backpacker->takeAnotherItem($item);
            ++$i;
        }

        $this->assertTrue($this->backpacker->getBackpack()->isFull());
        $this->assertEquals(1, count($this->backpacker->getBags()));
        $this->assertTrue($this->backpacker->getBags()[0] instanceof Bag);
        $this->assertEquals(1, count($this->backpacker->getBags()[0]->getItems()));
        $this->assertEquals('Leather', $this->backpacker->getBags()[0]->getItems()[0]->getName());
        $this->assertEquals('Clothes', $this->backpacker->getBags()[0]->getItems()[0]->getCategory()->getName());
    }

    /**
     * @testdox Backpack is full and first bag is full, insert the item in the next bag
     */
    public function testTakeOneItemIntoNextAvailableBagWhenBackpackIsFullAndBagIsFull(): void
    {
        $category = new Category('Clothes');
        $item     = new Item('Leather', $category);
        $limit    = $this->backpacker->getBackpack()->getCapacity() + Bag::MAX_CAPACITY + 1;

        $i = 0;
        while ($i < $limit) {
            if ($i == $this->backpacker->getBackpack()->getCapacity() ||
                $i == ($limit - 1)) {
                $this->backpacker->addBag(new Bag());
            }
            $this->backpacker->takeAnotherItem($item);
            ++$i;
        }

        $this->assertTrue($this->backpacker->getBackpack()->isFull());
        $this->assertEquals(2, count($this->backpacker->getBags()));
        $this->assertTrue($this->backpacker->getBags()[0] instanceof Bag);
        $this->assertTrue($this->backpacker->getBags()[1] instanceof Bag);
        $this->assertTrue($this->backpacker->getBags()[0]->isFull());
        $this->assertEquals(1, count($this->backpacker->getBags()[1]->getItems()));
        $this->assertEquals('Leather', $this->backpacker->getBags()[1]->getItems()[0]->getName());
        $this->assertEquals('Clothes', $this->backpacker->getBags()[1]->getItems()[0]->getCategory()->getName());
    }

    /**
     * @testdox Cannot exceed maximum number of bags
     */
    public function testMaxNumberOfBags(): void
    {
        $category = new Category('Clothes');
        $item     = new Item('Leather', $category);

        $this->expectErrorMessage('Maximum number of bags exceeded');

        $i = 0;
        while ($i < $this->backpacker->getBackpack()->getCapacity()) {
            $this->backpacker->takeAnotherItem($item);
            ++$i;
        }

        $i = 0;
        while ($i < ($this->backpacker->getMaxBags() + 1)) {
            $this->backpacker->addBag(new Bag());
            ++$i;

            $j = 0;
            while ($j < Bag::MAX_CAPACITY) {
                $this->backpacker->takeAnotherItem($item);
                ++$j;
            }
        }
    }
}
