<?php

include_once __DIR__ . "/../../../common/src/Service/UserService.php";
include_once __DIR__ . "/../../../common/src/Service/DBConnector.php";

class MigrationAddUserTable {

    private $conn;

    public function __construct(DBconnector $connector)
    {
        $this->conn = $connector->connect();
    }

    public function commit()
    {
        $result = mysqli_query($this->conn, "CREATE TABLE `user` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(256) NOT NULL,
            `phone` VARCHAR(256) NOT NULL UNIQUE,
            `email` VARCHAR(256) NOT NULL UNIQUE,
            `password` VARCHAR(256) NOT NULL,
            `roles` VARCHAR(256) NOT NULL,
            PRIMARY KEY (id)
        ) ENGINE = INNODB DEFAULT CHAR SET utf8");

        if (!$result) {
            echo mysqli_error($this->conn) . PHP_EOL;
        }
        
        $result = mysqli_query($this->conn, "
        INSERT INTO `user` (`name`, `phone`, `email`, `password`, `roles`)
        VALUES ('superadmin', '111', 'admin@mail.ru', '" . UserService::encodePassword('1')
        . "', '[\"ROLE_SUPER_ADMIN\"]');
        ");

        if (!$result) {
            echo mysqli_error($this->conn) . PHP_EOL;
        }
    }

    public function rollback()
    {
        $result = mysqli_query($this->conn, "DROP TABLE `user`");

        if (!$result) {
            echo mysqli_error($this->conn) . PHP_EOL;
        }
    }
}