<?php

class GildedRose {

    private $items;

    function __construct($items) {
        $this->items = $items;
    }

    function update_quality() {
        // TODO extract to method
        foreach ($this->items as $item) {
            // if is not aged and backpass then if quality si good and if not Sulfuras Qual --
            // TODO Extract to method
            // TODO Add conjured
            $this->decreaseQualityOfNotAgedBackpassOrSulfuras($item);
            
            // increase quality of Aged and Backpass
            $this->increaseQualityOfAgedAndBackpass($item);
            
            // all not sulfuras sellin -- 
            // TODO Comment on this work
            $this->decreaseSellIn($item);
            

            // TODO Comment what this do
            // 1)jei sell in mazesne uz nuli ir vardas nelygus Aged tada jei vardas nelygus back ir kokybe didesne uz 0
            // ir jei vardas nelygus sulfuras, tada maziname kokybe
            // 2)kitu atveju kokybe lygu kokybe-kokybe
            // TODO Extract to method
           
            $this->decreaseQualityOfConjuredItem($item);
            // TODO Add conjured item.
        }
    }

    function decreaseSellIn($item){
        $primary = $item;
        if ($item->name != 'Sulfuras, Hand of Ragnaros') {
            $item->sell_in = $item->sell_in - 1;
        }
        // return to check
        return ($primary->sell_in === $item->sell_in);
    }

    function decreaseQualityOfConjuredItem($item){
        if ($item->name == 'Conjured Mana Cake') {
            if($item->quality>0)
                $item->quality = $item->quality - 1;
        }
        return $item;
    }
    function increaseQualityOfAgedAndBackpass($item){
        if (($item->name == 'Aged Brie') || ($item->name == 'Backstage passes to a TAFKAL80ETC concert')){
            if ($item->quality < 50) {
                $item->quality = $item->quality + 1;
            }
            if ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {
                if ($item->sell_in < 11) {
                    if ($item->quality < 50) {
                        $item->quality = $item->quality + 1;
                    }
                }
                if ($item->sell_in < 6) {
                    if ($item->quality < 50) {
                        $item->quality = $item->quality + 1;
                    }
                }
                if ($item->sell_in < 0) {
                    $item->quality = 0;
                }
            }
        }
        return $item;
    }
    function decreaseQualityOfNotAgedBackpassOrSulfuras($item){
        if ($item->name != 'Aged Brie' and $item->name != 'Backstage passes to a TAFKAL80ETC concert') {
            if ($item->quality > 0) {
                if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                    $item->quality = $item->quality - 1;
                }
            }
        } 
        return $item;
    }
}

class Item {

    public $name;
    public $sell_in;
    public $quality;

    function __construct($name, $sell_in, $quality) {
        $this->name = $name;
        $this->sell_in = $sell_in;
        $this->quality = $quality;
    }

    public function __toString() {
        return "{$this->name}, {$this->sell_in}, {$this->quality}";
    }

}

