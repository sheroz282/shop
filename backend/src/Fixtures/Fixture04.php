<?php

include_once __DIR__ . "/../../../common/src/Service/DBConnector.php";

class Fixture04
{
    private $conn;

    private $data = [
        ['id' => 'null', 'title' => '1', 'address' => '1rgerdfshser3'],
        ['id' => 'null', 'title' => '2', 'address' => '1rgerdfshser3'],
        ['id' => 'null', 'title' => '3', 'address' => '1rgerdfshser3'],
        ['id' => 'null', 'title' => '4', 'address' => '1rgerdfshser3'],
        ['id' => 'null', 'title' => '5', 'address' => '1rgerdfshser3']
    ];

    public function __construct(DBConnector $conn)
    {
        $this->conn = $conn->connect();
    }

    public function run()
    {
        foreach ($this->data as $category) {
            $result = mysqli_query($this->conn, "INSERT INTO shops VALUES (
                " . $category['id'] . ", 
                '" . $category['title'] . "',
                '" . $category['address'] . "'
            )");
            
            if (!$result) {
                print mysqli_error($this->conn) . PHP_EOL;
            }
        }
    }
}