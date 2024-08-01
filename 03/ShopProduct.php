<?php

// Listing 3.1, 3.4, 3.33
class ShopProduct
{
    public $title;
    public $producerFirstName = "";
    public $producerMainName = "";
    public $price = 0;

    public function __construct(
        string $title,
        string $producerFirstName,
        string $producerMainName,
        float $price = 0
    ) {
        $this->title = $title;
        $this->producerFirstName = $producerFirstName;
        $this->producerMainName = $producerMainName;
        $this->price = $price;
    }

    public function getProducer()
    {
        return $this->producerFirstName . " " . $this->producerMainName;
    }
}
