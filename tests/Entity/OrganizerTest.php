<?php

namespace Habitissimo\Kata\Tests\Entity;

use PHPUnit\Framework\TestCase;
use Habitissimo\Kata\Entity\Bag;
use Habitissimo\Kata\Entity\Item;
use Habitissimo\Kata\Entity\Category;
use Habitissimo\Kata\Entity\Organizer;
use Habitissimo\Kata\Entity\Backpacker;

/**
 * Class OrganizerTest.
 */
class OrganizerTest extends TestCase
{
    /**
     * @testdox Organize (move and sort) the items between the backpack and one bag
     */
    public function testOrganizeItemsInBackpackAndOneBag(): void
    {
        $clothesCategory = new Category('Clothes');
        $metalsCategory  = new Category('Metals');
        $herbsCategory   = new Category('Herbs');

        $backpacker = new Backpacker();
        $backpacker->takeAnotherItem(new Item('Leather', $clothesCategory));
        $backpacker->takeAnotherItem(new Item('Iron', $metalsCategory));
        $backpacker->takeAnotherItem(new Item('Copper', $metalsCategory));
        $backpacker->takeAnotherItem(new Item('Marigold', $herbsCategory));
        $backpacker->takeAnotherItem(new Item('Wool', $clothesCategory));
        $backpacker->takeAnotherItem(new Item('Gold', $metalsCategory));
        $backpacker->takeAnotherItem(new Item('Silk', $clothesCategory));
        $backpacker->takeAnotherItem(new Item('Copper', $metalsCategory));
        $backpacker->addBag(new Bag([], $metalsCategory));
        $backpacker->takeAnotherItem(new Item('Copper', $metalsCategory));
        $backpacker->takeAnotherItem(new Item('Cherry Blossom', $herbsCategory));

        $organizer = new Organizer($backpacker);
        $organizer->organize();

        $this->assertEquals(6, count($backpacker->getBackpack()->getItems()));
        $this->assertEquals(1, count($backpacker->getBags()));
        $this->assertEquals(4, count($backpacker->getBags()[0]->getItems()));
        $this->assertEquals('Cherry Blossom', $backpacker->getBackpack()->getItems()[0]->getName());
        $this->assertEquals('Iron', $backpacker->getBackpack()->getItems()[1]->getName());
        $this->assertEquals('Leather', $backpacker->getBackpack()->getItems()[2]->getName());
        $this->assertEquals('Marigold', $backpacker->getBackpack()->getItems()[3]->getName());
        $this->assertEquals('Silk', $backpacker->getBackpack()->getItems()[4]->getName());
        $this->assertEquals('Wool', $backpacker->getBackpack()->getItems()[5]->getName());
        $this->assertEquals('Copper', $backpacker->getBags()[0]->getItems()[0]->getName());
        $this->assertEquals('Copper', $backpacker->getBags()[0]->getItems()[1]->getName());
        $this->assertEquals('Copper', $backpacker->getBags()[0]->getItems()[2]->getName());
        $this->assertEquals('Gold', $backpacker->getBags()[0]->getItems()[3]->getName());
    }

    /**
     * @testdox Organize (move and sort) the items between the backpack and one bag. Use a next available bag to store rest of bag items
     */
    public function testOrganizeItemsInBackpackAndOneBagsUsingNextAvailableBag(): void
    {
        $weaponsCategory = new Category('Weapons');
        $clothesCategory = new Category('Clothes');
        $metalsCategory  = new Category('Metals');
        $herbsCategory   = new Category('Herbs');

        $backpacker = new Backpacker();
        $backpacker->takeAnotherItem(new Item('Leather', $clothesCategory));
        $backpacker->takeAnotherItem(new Item('Axe', $weaponsCategory));
        $backpacker->takeAnotherItem(new Item('Dagger', $weaponsCategory));
        $backpacker->takeAnotherItem(new Item('Iron', $metalsCategory));
        $backpacker->takeAnotherItem(new Item('Copper', $metalsCategory));
        $backpacker->takeAnotherItem(new Item('Marigold', $herbsCategory));
        $backpacker->takeAnotherItem(new Item('Wool', $clothesCategory));
        $backpacker->takeAnotherItem(new Item('Gold', $metalsCategory));
        $backpacker->addBag(new Bag([], $metalsCategory));
        $backpacker->takeAnotherItem(new Item('Silk', $clothesCategory));
        $backpacker->takeAnotherItem(new Item('Copper', $metalsCategory));
        $backpacker->takeAnotherItem(new Item('Copper', $metalsCategory));
        $backpacker->takeAnotherItem(new Item('Cherry Blossom', $herbsCategory));
        $backpacker->addBag(new Bag([]));
        $backpacker->takeAnotherItem(new Item('Rose', $herbsCategory));
        $backpacker->takeAnotherItem(new Item('Gold', $metalsCategory));
        $backpacker->takeAnotherItem(new Item('Gold', $metalsCategory));

        $organizer = new Organizer($backpacker);
        $organizer->organize();

        $this->assertEquals(8, count($backpacker->getBackpack()->getItems()));
        $this->assertEquals(2, count($backpacker->getBags()));
        $this->assertEquals(4, count($backpacker->getBags()[0]->getItems()));
        $this->assertEquals(3, count($backpacker->getBags()[1]->getItems()));
        $this->assertEquals('Axe', $backpacker->getBackpack()->getItems()[0]->getName());
        $this->assertEquals('Cherry Blossom', $backpacker->getBackpack()->getItems()[1]->getName());
        $this->assertEquals('Dagger', $backpacker->getBackpack()->getItems()[2]->getName());
        $this->assertEquals('Gold', $backpacker->getBackpack()->getItems()[3]->getName());
        $this->assertEquals('Gold', $backpacker->getBackpack()->getItems()[4]->getName());
        $this->assertEquals('Iron', $backpacker->getBackpack()->getItems()[5]->getName());
        $this->assertEquals('Leather', $backpacker->getBackpack()->getItems()[6]->getName());
        $this->assertEquals('Marigold', $backpacker->getBackpack()->getItems()[7]->getName());
        $this->assertEquals('Copper', $backpacker->getBags()[0]->getItems()[0]->getName());
        $this->assertEquals('Copper', $backpacker->getBags()[0]->getItems()[1]->getName());
        $this->assertEquals('Copper', $backpacker->getBags()[0]->getItems()[2]->getName());
        $this->assertEquals('Gold', $backpacker->getBags()[0]->getItems()[3]->getName());
        $this->assertEquals('Rose', $backpacker->getBags()[1]->getItems()[0]->getName());
        $this->assertEquals('Silk', $backpacker->getBags()[1]->getItems()[1]->getName());
        $this->assertEquals('Wool', $backpacker->getBags()[1]->getItems()[2]->getName());
    }

    /**
     * @testdox Organize (move and sort) the items between backpack and two bags.
     */
    public function testOrganizeItemsInBackpackAndTwoBags(): void
    {
        $weaponsCategory = new Category('Weapons');
        $clothesCategory = new Category('Clothes');
        $metalsCategory  = new Category('Metals');
        $herbsCategory   = new Category('Herbs');

        $backpacker = new Backpacker();
        $backpacker->takeAnotherItem(new Item('Leather', $clothesCategory));
        $backpacker->takeAnotherItem(new Item('Axe', $weaponsCategory));
        $backpacker->takeAnotherItem(new Item('Dagger', $weaponsCategory));
        $backpacker->takeAnotherItem(new Item('Iron', $metalsCategory));
        $backpacker->takeAnotherItem(new Item('Copper', $metalsCategory));
        $backpacker->takeAnotherItem(new Item('Marigold', $herbsCategory));
        $backpacker->takeAnotherItem(new Item('Wool', $clothesCategory));
        $backpacker->takeAnotherItem(new Item('Gold', $metalsCategory));
        $backpacker->addBag(new Bag([], $metalsCategory));
        $backpacker->takeAnotherItem(new Item('Silk', $clothesCategory));
        $backpacker->takeAnotherItem(new Item('Copper', $metalsCategory));
        $backpacker->takeAnotherItem(new Item('Copper', $metalsCategory));
        $backpacker->takeAnotherItem(new Item('Cherry Blossom', $herbsCategory));
        $backpacker->addBag(new Bag([], $weaponsCategory));
        $backpacker->takeAnotherItem(new Item('Rose', $herbsCategory));
        $backpacker->takeAnotherItem(new Item('Gold', $metalsCategory));

        $organizer = new Organizer($backpacker);
        $organizer->organize();

        $this->assertEquals(8, count($backpacker->getBackpack()->getItems()));
        $this->assertEquals(2, count($backpacker->getBags()));
        $this->assertEquals(4, count($backpacker->getBags()[0]->getItems()));
        $this->assertEquals(2, count($backpacker->getBags()[1]->getItems()));
        $this->assertEquals('Cherry Blossom', $backpacker->getBackpack()->getItems()[0]->getName());
        $this->assertEquals('Gold', $backpacker->getBackpack()->getItems()[1]->getName());
        $this->assertEquals('Iron', $backpacker->getBackpack()->getItems()[2]->getName());
        $this->assertEquals('Leather', $backpacker->getBackpack()->getItems()[3]->getName());
        $this->assertEquals('Marigold', $backpacker->getBackpack()->getItems()[4]->getName());
        $this->assertEquals('Rose', $backpacker->getBackpack()->getItems()[5]->getName());
        $this->assertEquals('Silk', $backpacker->getBackpack()->getItems()[6]->getName());
        $this->assertEquals('Wool', $backpacker->getBackpack()->getItems()[7]->getName());
        $this->assertEquals('Copper', $backpacker->getBags()[0]->getItems()[0]->getName());
        $this->assertEquals('Copper', $backpacker->getBags()[0]->getItems()[1]->getName());
        $this->assertEquals('Copper', $backpacker->getBags()[0]->getItems()[2]->getName());
        $this->assertEquals('Gold', $backpacker->getBags()[0]->getItems()[3]->getName());
        $this->assertEquals('Axe', $backpacker->getBags()[1]->getItems()[0]->getName());
        $this->assertEquals('Dagger', $backpacker->getBags()[1]->getItems()[1]->getName());
    }
}
