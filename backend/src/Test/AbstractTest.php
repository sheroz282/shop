<?php

abstract class AbstractTest
{
    protected $conn;

    const DB_PRODUCT_NAME = 'shop';
    const DB_TEST_NAME = 'shop_test';

    public function __construct()
    {
        $this->conn = new DBConnector(
            'localhost', 
            'root', 
            'root', 
            'shop_test');
    }

    public function copyTableByName($name)
    {
        mysqli_query($this->conn->connect(), "INSERT INTO " . self::DB_TEST_NAME . "." . $name
                . "SELECT * FROM " . self::DB_PRODUCT_NAME . "." . $name);
    }

    public function createTableByName($name)
    {
        $query = "show create table " . self::DB_PRODUCT_NAME . "." . $name;

        $result = mysqli_query($this->conn->connect(), $query);
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);

        mysqli_query($this->conn->connect(), $result['0']['Create Table']);
        mysqli_query($this->conn->connect(), "TRUNCATE TABLE " . self::DB_TEST_NAME . "." . $name);
    }

    public function dropTableByName($name)
    {
        mysqli_query($this->conn->connect(), "DROP TABLE " . self::DB_TEST_NAME . '.' . $name);
    }
}