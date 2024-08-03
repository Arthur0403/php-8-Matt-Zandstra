<?php

// Listing 4.9
abstract class ShopProductWriter
{
    protected array $products = [];
    public function addProduct(ShopProduct $shopProduct): void
    {
        $this->products[] = $shopProduct;
    }

    // Абстрактный метод без тела и обязан быть реализован в дочерних классах
    // Создавая абстрактный метод я гарантирую, что его реализация будет доступна в дочерних классах
    // но его реализация остаются неопределенными.

    abstract public function write();
}

//TODO: написать примеры реализации двух классов, которые реализуют абстрактный метод с.115
