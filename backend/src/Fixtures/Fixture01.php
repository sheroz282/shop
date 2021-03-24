<?php

include_once __DIR__ . "/../../../common/src/Service/DBConnector.php";

class Fixture01
{
    private $conn;

    private $data = [
        [
            'id' => 'null',
            'title' => 'тест',
            'picture' => '01.png',
            'priview' => 'wwww',
            'content' => 'тест',
            'price' => '121',
            'status' => '121',
            'created' => '2021-01-19 09:34:35',
            'updated' => '2021-01-19 09:34:35'
        ],
        [
            'id' => 'null',
            'title' => 'тест',
            'picture' => '01.png',
            'priview' => 'wwww',
            'content' => 'тест',
            'price' => '121',
            'status' => '121',
            'created' => '2021-01-19 09:34:35',
            'updated' => '2021-01-19 09:34:35'
        ],
        [
            'id' => 'null',
            'title' => 'тест',
            'picture' => '01.png',
            'priview' => 'wwww',
            'content' => 'тест',
            'price' => '121',
            'status' => '121',
            'created' => '2021-01-19 09:34:35',
            'updated' => '2021-01-19 09:34:35'
        ],
        [
            'id' => 'null',
            'title' => 'тест',
            'picture' => '01.png',
            'priview' => 'wwww',
            'content' => 'тест',
            'price' => '121',
            'status' => '121',
            'created' => '2021-01-19 09:34:35',
            'updated' => '2021-01-19 09:34:35'
        ],
        [
            'id' => 'null',
            'title' => 'тест',
            'picture' => '01.png',
            'priview' => 'wwww',
            'content' => 'тест',
            'price' => '121',
            'status' => '121',
            'created' => '2021-01-19 09:34:35',
            'updated' => '2021-01-19 09:34:35'
        ],
        [
            'id' => 'null',
            'title' => 'тест',
            'picture' => '01.png',
            'priview' => 'wwww',
            'content' => 'тест',
            'price' => '121',
            'status' => '121',
            'created' => '2021-01-19 09:34:35',
            'updated' => '2021-01-19 09:34:35'
        ],
        [
            'id' => 'null',
            'title' => 'тест',
            'picture' => '01.png',
            'priview' => 'wwww',
            'content' => 'тест',
            'price' => '121',
            'status' => '121',
            'created' => '2021-01-19 09:34:35',
            'updated' => '2021-01-19 09:34:35'
        ],
        [
            'id' => 'null',
            'title' => 'тест',
            'picture' => '01.png',
            'priview' => 'wwww',
            'content' => 'тест',
            'price' => '121',
            'status' => '121',
            'created' => '2021-01-19 09:34:35',
            'updated' => '2021-01-19 09:34:35'
        ],
        [
            'id' => 'null',
            'title' => 'тест',
            'picture' => '01.png',
            'priview' => 'wwww',
            'content' => 'тест',
            'price' => '121',
            'status' => '121',
            'created' => '2021-01-19 09:34:35',
            'updated' => '2021-01-19 09:34:35'
        ],
        [
            'id' => 'null',
            'title' => 'тест',
            'picture' => '01.png',
            'priview' => 'wwww',
            'content' => 'тест',
            'price' => '121',
            'status' => '121',
            'created' => '2021-01-19 09:34:35',
            'updated' => '2021-01-19 09:34:35'
        ],
    ];

    public function __construct(DBConnector $conn)
    {
        $this->conn = $conn->connect();
    }

    public function run()
    {
        foreach ($this->data as $product) {
            copy ( __DIR__ . "/../../fixtures_pics/" . $product['picture'],  __DIR__ . "/../../../uploads/products/" . $product['picture']);

            $result = mysqli_query($this->conn, "INSERT INTO products VALUES (
            " . $product['id'] . ", 
            '" . $product['title'] . "',
            '" . $product['picture'] . "',
            '" . $product['preview'] . "',
            '" . $product['content'] . "',
            '" . $product['price'] . "',
            '" . $product['status'] . "',
            '" . $product['created'] . "',
            '" . $product['updated'] . "'
        )");
        
            if (!$result) {
                print mysqli_error($this->conn) . PHP_EOL;
            }
        }
    }
}