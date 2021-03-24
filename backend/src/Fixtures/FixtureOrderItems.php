<?php

include_once __DIR__ . "/../../../common/src/Service/DBConnector.php";

class FixtureOrderItems
{
    private $conn;

    private $data = [
        ['id' => '1', 'order_id' => '1', 'product_id' => '0', 'quantity' => '1'],
        ['id' => '2', 'order_id' => '2', 'product_id' => '0', 'quantity' => '1'],
        ['id' => '3', 'order_id' => '2', 'product_id' => '0', 'quantity' => '1'],
        ['id' => '4', 'order_id' => '1', 'product_id' => '0', 'quantity' => '1'],
        ['id' => '5', 'order_id' => '1', 'product_id' => '0', 'quantity' => '1'],
        ['id' => '6', 'order_id' => '1', 'product_id' => '0', 'quantity' => '1']
    ];

    public function __construct(DBConnector $conn)
    {
        $this->conn = $conn->connect();
    }

    public function run()
    {
        foreach ($this->data as $category) {
            $result = mysqli_query($this->conn, "INSERT INTO order_item VALUES (
                " . $category['id'] . ", 
                '" . $category['order_id'] . "',
                '" . $category['product_id'] . "',
                '" . $category['quantity'] . "'
            )");
            
            if (!$result) {
                print mysqli_error($this->conn) . PHP_EOL;
            }
        }
    }
}