<?php

//Listring 4.15
interface Chargeable
{
    public function getPrice(): float;
}

//Usage
class Product implements Chargeable
{
    protected float $price;
    public function getPrice(): float
    {
        return $this->price;
    }
}
