<?php

class MigrationAddFieldCityToShops {

    private $conn;

    public function __construct(DBconnector $connector)
    {
        $this->conn = $connector->connect();
    }

    public function commit()
    {
        $result = mysqli_query($this->conn, "ALTER TABLE shops ADD city INT NOT NULL DEFAULT 0");

        if (!$result) {
            echo mysqli_error($this->conn) . PHP_EOL;
        }
    }

    public function rollback()
    {
        $result = mysqli_query($this->conn, "ALTER TABLE shops DROP COLUMN city");

        if (!$result) {
            echo mysqli_error($this->conn) . PHP_EOL;
        }
    }
}