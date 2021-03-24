<?php

include_once __DIR__ . "/../Model/Basket.php";
include_once __DIR__ . "/../Model/BasketItem.php";
include_once __DIR__ . "/../Service/BasketService.php";

class BasketSessionService extends BasketService
{
    public function getBasketProducts($basketId)
    {
        $session = $_SESSION['basket'] ?? [];

        if (empty($session) && sizeof($session) == 0) {
            return $session;
        }

        return unserialize($session);
    }

    public static function getBasketByUserId($userId)
    {

    }

    public function updateBasketItem($basketId, $productId, $qty)
    {   
        
    }

    public function deleteBasketItem($basketId, $productId)
    { 
        
    }

    public function createBasketItem($basketId, $productId, $qty)
    {
        $item = [
            'product_id' => $productId,
            'basket_id' => $basketId,
            'quantity' => $qty
        ];

        $session = $this -> getBasketProducts($basketId);

        $session[] = $item;

        $_SESSION['basket'] = serialize($session);
    }

    public function clearBasket($basketId)
    {

    }
    
    public function getBasketIdByUserId($userId)
    {
        
    }
}