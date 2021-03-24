<?php

include_once __DIR__ . "/../../../common/src/Service/OrderService.php";
include_once __DIR__ . "/../../../common/src/Service/UserService.php";
include_once __DIR__ . "/../../../common/src/Service/BasketCookieService.php";
include_once __DIR__ . "/../../../common/src/Service/BasketDBService.php";
include_once __DIR__ . "/../../../common/src/Model/Order.php";
include_once __DIR__ . "/../../../common/src/Model/OrderItem.php";

class OrderController
{
    /** @var BasketService $basketService */
    private $basketService;

    private $conn;

    public function __construct($conn = null)
    {
        // TODO 

      //  $this->basketService = new BasketSessionService();

        if (!empty($conn)) {
            $this->conn = $conn;          
            $this->basketService = new BasketDBService($conn);
        } else { 
            $this->basketService = new BasketDBService();
        }
    }

    public function index()
    {
        include_once __DIR__ . "/../../views/order/form.php";
    }

    public function create()
    {
        $name = htmlspecialchars($_POST['name']);

        $phone = htmlspecialchars($_POST['phone']);

        $email = htmlspecialchars($_POST['email']);
        $delivery = (int)$_POST['delivery'];
        $payment = (int)$_POST['payment'];
        $comment = htmlspecialchars($_POST['comment']);
        $userId = UserService::getCurrentUser()['id'] ?? 0;
        $total = 0;
        $status = OrderService::STATUS_NEW;
        $updated = date('Y-m-d H:i:s', time());

        $order = new Order(
            null, 
            $userId, 
            $payment, 
            $delivery, 
            $total, 
            $comment, 
            $name, 
            $phone, 
            $email, 
            $status,
            $updated);

        if (!empty($this->conn)) {
                $order->setConn($this->conn);
            }

        $orderId = $order->save();

        if (empty($orderId)) {
            throw new Exception("Order ID is null", 400);
        }

        $baskerId = $this->basketService->getBasketIdByUserId($userId);
        $items = $this->basketService->getBasketProducts($baskerId);

        if (empty($items)) {
            throw new Exception("Basket is empty", 400);
        }

        foreach ($items as $item) {
            $orderItem = new OrderItem($orderId, (int)$item['product_id'], (int)$item['quantity']);
            if (!empty($this->conn)) { $orderItem->setConn($this->conn); }
            $orderItem->save();
        }


        $this->basketService->clearBasket($baskerId);

        header("Location: /frontend/index.php?model=order&action=success&order_id=" . $orderId);
    }

    public function success()
    {
        $orderId = (int)$_GET['order_id'];
        
        include_once __DIR__ . "/../../views/order/success.php";
    }
}