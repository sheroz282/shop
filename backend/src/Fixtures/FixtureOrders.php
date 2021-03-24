<?php

include_once __DIR__ . "/../../../common/src/Service/DBConnector.php";

class FixtureOrders
{
    private $conn;

    private $data = [
        ['id' => '1', 'user_id' => '1', 'total' => '0', 'payment_id' => '1', 'delivery_id' => '1', 'comment' => 'vvv', 'name' => 'aaa', 'phone' => '000000000', 'email' => 'ee@dd.rr', 'status' => '1', 'created' => '2021-02-27 19:54:34', 'updated' => '2021-02-27 19:54:35'],
        ['id' => '2', 'user_id' => '1', 'total' => '0', 'payment_id' => '1', 'delivery_id' => '1', 'comment' => 'vvv', 'name' => 'aaa', 'phone' => '000000000', 'email' => 'ee@dd.rr', 'status' => '1', 'created' => '2021-02-27 19:54:34', 'updated' => '2021-02-27 19:54:35']
    ];

    public function __construct(DBConnector $conn)
    {
        $this->conn = $conn->connect();
    }

    public function run()
    {
        foreach ($this->data as $category) {
            $result = mysqli_query($this->conn, "INSERT INTO orders VALUES (
                " . $category['id'] . ", 
                '" . $category['user_id'] . "',
                '" . $category['total'] . "',
                '" . $category['payment_id'] . "',
                '" . $category['delivery_id'] . "',
                '" . $category['comment'] . "',
                '" . $category['name'] . "',
                '" . $category['phone'] . "',
                '" . $category['email'] . "',
                '" . $category['status'] . "',
                '" . $category['created'] . "',
                '" . $category['updated'] . "'
            )");
            
            if (!$result) {
                print mysqli_error($this->conn) . PHP_EOL;
            }
        }
    }
}