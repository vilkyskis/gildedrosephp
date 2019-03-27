<?php

require_once '../src/gilded_rose.php';
require_once 'PHPUnit/Autoload.php';

class GildedRoseTest extends \PHPUnit\Framework\TestCase {

    function createObject(){
        $items = array(new Item('+5 Dexterity Vest', 10, 20),
        new Item('Aged Brie', 2, 0),
        new Item('Elixir of the Mongoose', 5, 7),
        new Item('Sulfuras, Hand of Ragnaros', 0, 80),
        new Item('Sulfuras, Hand of Ragnaros', -1, 80),
        new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20),
        new Item('Backstage passes to a TAFKAL80ETC concert', 10, 49),
        new Item('Backstage passes to a TAFKAL80ETC concert', 5, 49),
        // this conjured item does not work properly yet
        //"Conjured" items degrade in Quality twice as fast as normal items
        new Item('Conjured Mana Cake', 3, 6));
        return $items;
    }

    function createExpectedResults(){
        $items = array(new Item('+5 Dexterity Vest', 9, 19),
        new Item('Aged Brie', 1, 1),
        new Item('Elixir of the Mongoose', 4, 6),
        new Item('Sulfuras, Hand of Ragnaros', 0, 80),
        new Item('Sulfuras, Hand of Ragnaros', -1, 80),
        new Item('Backstage passes to a TAFKAL80ETC concert', 14, 21),
        new Item('Backstage passes to a TAFKAL80ETC concert', 9, 50),
        new Item('Backstage passes to a TAFKAL80ETC concert', 4, 50),
        // this conjured item does not work properly yet
        
        new Item('Conjured Mana Cake', 2, 5));
        return $items;
    }

    function testNameChange() {  
        $items = $this->createObject();   
        $items2 = $this->createExpectedResults();    
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        for ($i = 0; $i<sizeof($items); $i++)
            $this->assertEquals($items2[$i]->name, $items[$i]->name);
    }

    function testSellIn() {   
        $items = $this->createObject(); 
        $items2 = $this->createExpectedResults();         
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        for ($i = 0; $i<sizeof($items); $i++)
            $this->assertEquals($items2[$i]->sell_in, $items[$i]->sell_in);
    }

    function testQuality() {   
        $items = $this->createObject(); 
        $items2 = $this->createExpectedResults();         
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        for ($i = 0; $i<sizeof($items); $i++)
            $this->assertEquals($items2[$i]->quality, $items[$i]->quality);
    }

}
