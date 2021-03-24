<?php

include_once __DIR__ . "/../../../common/src/Service/DBConnector.php";

class Fixture02
{
    private $conn;

    private $data = [
        ['id' => 'null', 'title' => '1', 'groupId' => '3443443', 'parentId' => '3434334'],
        ['id' => 'null', 'title' => '2', 'groupId' => '3443443', 'parentId' => '3434334'],
        ['id' => 'null', 'title' => '3', 'groupId' => '3443443', 'parentId' => '3434334'],
        ['id' => 'null', 'title' => '4', 'groupId' => '3443443', 'parentId' => '3434334'],
        ['id' => 'null', 'title' => '5', 'groupId' => '3443443', 'parentId' => '3434334'],
        ['id' => 'null', 'title' => '6', 'groupId' => '3443443', 'parentId' => '3434334'],
        ['id' => 'null', 'title' => '7', 'groupId' => '3443443', 'parentId' => '3434334'],
        ['id' => 'null', 'title' => '8', 'groupId' => '3443443', 'parentId' => '3434334'],
        ['id' => 'null', 'title' => '9', 'groupId' => '3443443', 'parentId' => '3434334'],
        ['id' => 'null', 'title' => '1', 'groupId' => '3443443', 'parentId' => '3434334']
    ];

    public function __construct(DBConnector $conn)
    {
        $this->conn = $conn->connect();
    }

    public function run()
    {
        foreach ($this->data as $product) {
            $result = mysqli_query($this->conn, "INSERT INTO categories VALUES (
                " . $product['id'] . ", 
                '" . $product['title'] . "',
                '" . $product['groupId'] . "',
                '" . $product['parentId'] . "'
            )");
        
            if (!$result) {
                print mysqli_error($this->conn) . PHP_EOL;
            }
        }
    }
}