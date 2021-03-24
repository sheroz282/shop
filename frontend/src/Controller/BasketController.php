<?php

include_once __DIR__ . "/../../../common/src/Service/BasketService.php";
include_once __DIR__ . "/../../../common/src/Service/BasketSessionService.php";
include_once __DIR__ . "/../../../common/src/Service/BasketCookieService.php";
include_once __DIR__ . "/../../../common/src/Service/BasketDBService.php";
include_once __DIR__ . "/../../../common/src/Service/UserService.php";
include_once __DIR__ . "/../../../common/src/Service/ProductService.php";
include_once __DIR__ . "/../../../common/src/Model/BasketItem.php";
include_once __DIR__ . "/../../../common/src/Model/Product.php";


class BasketController
{
    public $user;
    public $basket;
    public $items;
    public $basketService;
 
    public function __construct()
    {
        $this -> user = UserService::getCurrentUser();

        if (!isset($this -> user['login'])) {
            throw new Exception('No permission', 404);
        } 

        $this -> basket = BasketDBService::getBasketByUserId($this -> user['id']);  
        $this -> basketService = new BasketDBService();
       // $this -> basketService = new BasketSessionService();
       // $this -> basketService = new BasketCookieService();
        $this -> items = $this -> basketService -> getBasketProducts((int)$this -> basket['id']);
    }

    public function addProduct()
    {
        $productId = (int)$_POST['product_id'];
        $qty = (int)$_POST['quantity'];

        if (empty($productId) || empty($qty)) {
            throw new Exception("Empty product");
        }     

        foreach ($this->items as $item) {
            if ($item['product_id'] == $productId) {
                $this->basketService->updateBasketItem($this->basket['id'], $productId, $qty);
        
                $this->redirectToBasket();
                die();
            }
        }
 
        $this->basketService->createBasketItem($this -> basket['id'], $productId, $qty);

        $this->redirectToBasket();
    }

    public function view()
    {
        $result = (new ProductService()) -> getBasketItems($this->items);
        $items = $result['items'];
        $total = $result['total'];

        include_once __DIR__ . "/../../views/basket/view.php";
    }

    public function delete()
    {
        $this -> basketService -> deleteBasketItem((int)$this -> basket['id'], (int)$_POST['product_id']);

        $this -> redirectToBasket();
    }

    public function change()
    {
        $this -> basketService -> updateBasketItem((int)$this -> basket['id'], (int)$_POST['product_id'], (int)$_POST['qty']);

        $this -> redirectToBasket();
    }

    public function redirectToBasket()
    {
        header("location: /frontend/index.php?model=basket&action=view");
    }
}