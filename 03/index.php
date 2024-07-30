<?php

include_once 'ShopProduct.php';

//3.2
$product1 = new ShopProduct();
$product2 = new ShopProduct();

//3.5
print $product1->title;

//3.6
$product1->title = "Собачье сердце";
$product2->title = "Ревизор";

// 3.7 - dynamic props
/*
 * Bad practice
 * 1. Мы не понимаем какие свойства есть изначально, а какие добавлены
 * 2. Легко опечататься
 * 3. Нельзя управлять модификаторами доступа
 */
$product1->arbitraryAddition = "Дополнительный параметр";
