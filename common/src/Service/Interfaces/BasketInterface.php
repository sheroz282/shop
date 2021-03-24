<?php

interface BasketInterface
{
    public static function getBasketByUserId($userId);

    public function updateBasketItem($basketId, $productId, $qty);

    public function deleteBasketItem($basketId, $productId);

    public function createBasketItem($basketId, $productId, $qty);

    public function getBasketProducts($basketId);

    public function clearBasket($basketId);

    public function getBasketIdByUserId($userId);
}