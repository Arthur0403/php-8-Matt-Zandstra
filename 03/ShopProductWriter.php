<?php

// Listing 3.29
class ShopProductWriter
{
    public function write($shopProduct)
    {
        $str = $shopProduct->title . ": " . $shopProduct->getProducer() . " (" . $shopProduct->price . ")\n";
        print $str;
    }
}

//Usage
$product1 = new ShopProduct("Собачье сердце", "Михаил", "Булгаков", 5.99);
$writer = new ShopProductWriter();
$writer->write($product1);
