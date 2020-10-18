<?php

namespace Habitissimo\Kata\Tests\Entity;

use PHPUnit\Framework\TestCase;
use Habitissimo\Kata\Entity\Bag;
use Habitissimo\Kata\Entity\Item;
use Habitissimo\Kata\Entity\Util;
use Habitissimo\Kata\Entity\Category;

/**
 * Class BagTest.
 */
class BagTest extends TestCase
{
    /** @var Bag */
    protected $bag;

    protected function setUp(): void
    {
        $this->bag = new Bag();
    }

    /**
     * @testdox When the object is instantiated, the bag is empty
     */
    public function testCreateNewBag(): void
    {
        $this->assertEmpty($this->bag->getItems());
    }

    /**
     * @testdox Put an item into a bag without category
     */
    public function testAddItemIntoBagWithoutCategory(): void
    {
        $category = new Category('Clothes');
        $item     = new Item('Leather', $category);

        $this->bag->addItem($item);

        $this->assertEquals('Leather', $this->bag->getItems()[0]->getName());
        $this->assertEquals('Clothes', $this->bag->getItems()[0]->getCategory()->getName());
    }

    /**
     * @testdox Put an item into a bag with the same category of the item
     */
    public function testAddItemIntoBagWithTheSameCategory(): void
    {
        $category = new Category('Clothes');
        $item     = new Item('Leather', $category);

        $this->bag = new Bag([], $category);
        $this->bag->addItem($item);

        $this->assertEquals('Leather', $this->bag->getItems()[0]->getName());
        $this->assertTrue(Util::checkEqualCategories($item->getCategory(), $this->bag->getCategory()));
    }

    /**
     * @testdox Put an item into a bag with different category of the item
     */
    public function testAddItemIntoBagWithDiferentCategory(): void
    {
        $category = new Category('Clothes');
        $item     = new Item('Leather', $category);

        $category  = new Category('Metal');
        $this->bag = new Bag([], $category);
        $this->bag->addItem($item);

        $this->assertEquals('Leather', $this->bag->getItems()[0]->getName());
        $this->assertFalse(Util::checkEqualCategories($item->getCategory(), $this->bag->getCategory()));
    }

    /**
     * @testdox Cannot exceed maximum capacity of the bag
     */
    public function testBagMaxCapacity(): void
    {
        $category = new Category('Clothes');
        $item     = new Item('Leather', $category);

        $this->expectErrorMessage('Maximum capacity exceeded');

        $i = 0;
        while ($i < ($this->bag->getCapacity() + 1)) {
            $this->bag->addItem($item);
            ++$i;
        }
    }

    /**
     * @testdox When the bag is full of items
     */
    public function testBagIsFull(): void
    {
        $category = new Category('Clothes');
        $item     = new Item('Leather', $category);

        $i = 0;
        while ($i < $this->bag->getCapacity()) {
            $this->bag->addItem($item);
            ++$i;
        }

        $this->assertTrue($this->bag->isFull());
    }
}
