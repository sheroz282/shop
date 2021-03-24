<?php

include_once __DIR__ . "/../../../common/src/Service/DBConnector.php";

class FixtureBasket
{
    private $conn;

    private $data = [
        ['id' => '1', 'user_id' => '1']
    ];

    public function __construct(DBConnector $conn)
    {
        $this->conn = $conn->connect();
    }

    public function run()
    {
        foreach ($this->data as $category) {
            $result = mysqli_query($this->conn, "INSERT INTO basket VALUES (
                " . $category['id'] . ", 
                '" . $category['user_id'] . "'
            )");
            
            if (!$result) {
                print mysqli_error($this->conn) . PHP_EOL;
            }
        }
    }
}