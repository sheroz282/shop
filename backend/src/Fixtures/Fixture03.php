<?php

include_once __DIR__ . "/../../../common/src/Service/DBConnector.php";

class Fixture03
{
    private $conn;

    private $data = [
        ['id' => 'null', 'title' => '1', 'content' => '1rgerdfshser3', 'created' => '2021-01-19 09:34:35'],
        ['id' => 'null', 'title' => '2', 'content' => '1rgerdfshser3', 'created' => '2021-01-19 09:34:35'],
        ['id' => 'null', 'title' => '3', 'content' => '1rgerdfshser3', 'created' => '2021-01-19 09:34:35'],
        ['id' => 'null', 'title' => '4', 'content' => '1rgerdfshser3', 'created' => '2021-01-19 09:34:35'],
        ['id' => 'null', 'title' => '5', 'content' => '1rgerdfshser3', 'created' => '2021-01-19 09:34:35'],
        ['id' => 'null', 'title' => '6', 'content' => '1rgerdfshser3', 'created' => '2021-01-19 09:34:35'],
        ['id' => 'null', 'title' => '7', 'content' => '1rgerdfshser3', 'created' => '2021-01-19 09:34:35'],
        ['id' => 'null', 'title' => '8', 'content' => '1rgerdfshser3', 'created' => '2021-01-19 09:34:35'],
        ['id' => 'null', 'title' => '9', 'content' => '1rgerdfshser3', 'created' => '2021-01-19 09:34:35'],
        ['id' => 'null', 'title' => '10', 'content' => '1rgerdfshser3', 'created' => '2021-01-19 09:34:35']
    ];

    public function __construct(DBConnector $conn)
    {
        $this->conn = $conn->connect();
    }

    public function run()
    {
        foreach ($this->data as $product) {
            $result = mysqli_query($this->conn, "INSERT INTO news VALUES (
                " . $product['id'] . ", 
                '" . $product['title'] . "',
                '" . $product['content'] . "',
                '" . $product['created'] . "'
            )");
        
            if (!$result) {
                print mysqli_error($this->conn) . PHP_EOL;
            }
        }
    }
}