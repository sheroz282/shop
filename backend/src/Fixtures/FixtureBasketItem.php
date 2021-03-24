<?php

include_once __DIR__ . "/../../../common/src/Service/DBConnector.php";

class FixtureBasketItem
{
    private $conn;

    private $data = [
        ['id' => '1', 'basket_id' => '1', 'product_id' => '1', 'quantity' => '1'],
        ['id' => '2', 'basket_id' => '1', 'product_id' => '1', 'quantity' => '1'],
        ['id' => '3', 'basket_id' => '1', 'product_id' => '1', 'quantity' => '1']
    ];

    public function __construct(DBConnector $conn)
    {
        $this->conn = $conn->connect();
    }

    public function run()
    {
        foreach ($this->data as $category) {
            $result = mysqli_query($this->conn, "INSERT INTO basket_item VALUES (
                " . $category['id'] . ", 
                '" . $category['basket_id'] . "', 
                '" . $category['product_id'] . "', 
                '" . $category['quantity'] . "'
            )");
            
            if (!$result) {
                print mysqli_error($this->conn) . PHP_EOL;
            }
        }
    }
}