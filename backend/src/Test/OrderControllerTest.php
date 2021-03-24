<?php

include_once __DIR__ . '/AbstractTest.php';
include_once __DIR__ . '/../Fixtures/FixtureBasket.php';
include_once __DIR__ . '/../../../frontend/src/Controller/OrderController.php';

class OrderControllerTest extends AbstractTest
{
    public function testCreate()
    {
        try {
            $this->dropTableByName('basket');
            $this->dropTableByName('basket_item');
            $this->dropTableByName('user');
            $this->dropTableByName('products');
            $this->dropTableByName('orders');
            $this->dropTableByName('order_item');
        } catch (Exception $e) {}


        $this->createTableByName('basket');
        $this->createTableByName('basket_item');
        $this->createTableByName('user');
        $this->createTableByName('products');
        $this->createTableByName('orders');
        $this->createTableByName('order_item');

        $this->copyTableByName('user');
        $this->copyTableByName('products');


        (new FixtureBasket($this->conn))->run();
        (new FixtureBasketItem($this->conn))->run();

        $_POST = [
            'name' => 'Rasul',
            'phone' => '000000000',
            'email' => 'aa@aa.aa',
            'delivery' => 2,
            'payment' => 2,
            'comment' => 'comment'
        ];
        
        $orderController = new OrderController($this->conn->connect());
        $orderController->create();




        $orders = (new Order())->setConn($this->conn->connect())->all();

        if (sizeof($orders) !== 1) {
            print "Wrong orders count" . PHP_EOL;
            die('TEST WAS CRESHED');
        }

        $order = reset($orders);
        foreach (['email' => $_POST['email'], 'phone' => $_POST['phone']] as $key => $value) {    
            if ($order[$key] !== $value) {
                print "Wrong value " . $key . PHP_EOL;
                die('TEST WAS CRESHED');
            }
        }

        $orderItems = (new OrderItem())->setConn($this->conn->connect())->getByBasketId($order['id']);

        if (sizeof($orderItems) !== 3) {
            print "Wrong orders count" . PHP_EOL;
            die('TEST WAS CRESHED');
        }

        foreach ($orderItems as $orderItem) {
            if (!in_array($orderItem['product_id'], [1, 3, 5])) {
                print "Wrong orders id = " . $orderItem['product_id'] . PHP_EOL;
                die('TEST WAS CRESHED');
            }
        }

        $_POST = [];

        $this->dropTableByName('basket');
        $this->dropTableByName('basket_item');
        $this->dropTableByName('user');
        $this->dropTableByName('products');
        $this->dropTableByName('orders');
        $this->dropTableByName('order_item');
    }
}