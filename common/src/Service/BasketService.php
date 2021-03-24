<?php

include_once __DIR__ . "/Interfaces/BasketInterface.php";

abstract class BasketService implements BasketInterface
{
    abstract public static function getBasketByUserId($userId);

    abstract public function updateBasketItem($basketId, $productId, $qty);

    abstract public function deleteBasketItem($basketId, $productId);

    abstract public function createBasketItem($basketId, $productId, $qty);

    abstract public function getBasketProducts($basketId);

    abstract public function clearBasket($basketId);

    abstract public function getBasketIdByUserId($userId);
}