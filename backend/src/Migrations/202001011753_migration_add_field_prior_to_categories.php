<?php

class MigrationAddFieldPriorToCategory {

    private $conn;

    public function __construct(DBconnector $connector)
    {
        $this->conn = $connector->connect();
    }

    public function commit()
    {
        $result = mysqli_query($this->conn, "ALTER TABLE categories ADD prior INT NOT NULL DEFAULT 0");

        if (!$result) {
            echo mysqli_error($this->conn) . PHP_EOL;
        }
    }

    public function rollback()
    {
        $result = mysqli_query($this->conn, "ALTER TABLE categories DROP COLUMN prior");

        if (!$result) {
            echo mysqli_error($this->conn) . PHP_EOL;
        }
    }
}