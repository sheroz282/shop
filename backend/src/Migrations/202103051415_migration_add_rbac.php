<?php

include_once __DIR__ . "/../../../common/src/Service/UserService.php";
include_once __DIR__ . "/../../../common/src/Service/DBConnector.php";

class MigrationAddRbac {

    private $conn;

    public function __construct(DBconnector $connector)
    {
        $this->conn = $connector->connect();
    }

    public function commit()
    {
        $result = mysqli_query($this->conn, "CREATE TABLE `rbac_role` (
            `role` VARCHAR(64) NOT NULL UNIQUE
        ) ENGINE = INNODB DEFAULT CHAR SET utf8");

        if (!$result) {
            echo mysqli_error($this->conn) . PHP_EOL;
        }

        $result = mysqli_query($this->conn, "CREATE TABLE `rbac_permission` (
            `permission` VARCHAR(128) NOT NULL UNIQUE
        ) ENGINE = INNODB DEFAULT CHAR SET utf8");

        if (!$result) {
            echo mysqli_error($this->conn) . PHP_EOL;
        }

        $result = mysqli_query($this->conn, "CREATE TABLE `rbac_access` (
            `role` VARCHAR(128) NOT NULL,
            `permission` VARCHAR(128) NOT NULL
        ) ENGINE = INNODB DEFAULT CHAR SET utf8");

        if (!$result) {
            echo mysqli_error($this->conn) . PHP_EOL;
        }

       $result = mysqli_query($this->conn, "
            INSERT INTO `rbac_role` (`role`)
            VALUES ('ROLE_SUPERADMIN'), ('ROLE_MANAGER'), ('ROLE_SHOP_MANAGER'), 
            ('ROLE_SHOP_ADMIN'), ('ROLE_PRODUCT_ADMIN')
        ");

        if (!$result) {
            echo mysqli_error($this->conn) . PHP_EOL;
        }

        //Shop, Product, Delivery, Payment
        $result = mysqli_query($this->conn, "
            INSERT INTO `rbac_permission` (`permission`)
            VALUES ('SHOP_READ'), 
                ('SHOP_CREATE'), 
                ('SHOP_UPDATE'), 
                ('SHOP_DELETE'),
                ('PRODUCT_READ'), 
                ('PRODUCT_CREATE'), 
                ('PRODUCT_UPDATE'), 
                ('PRODUCT_DELETE'),
                ('DELIVERY_READ'), 
                ('DELIVERY_CREATE'), 
                ('DELIVERY_UPDATE'), 
                ('DELIVERY_DELETE'),
                ('PAYMENT_READ'), 
                ('PAYMENT_CREATE'), 
                ('PAYMENT_UPDATE'), 
                ('PAYMENT_DELETE')
        ");

        if (!$result) {
            echo mysqli_error($this->conn) . PHP_EOL;
        }


        $result = mysqli_query($this->conn, "
            INSERT INTO `rbac_access` (`role`, `permission`)
            VALUES ('ROLE_ADMIN', 'SHOP_READ'), 
                ('ROLE_ADMIN', 'SHOP_CREATE'), 
                ('ROLE_ADMIN', 'SHOP_UPDATE'), 
                ('ROLE_ADMIN', 'SHOP_DELETE'),
                ('ROLE_ADMIN', 'PRODUCT_READ'), 
                ('ROLE_ADMIN', 'PRODUCT_CREATE'), 
                ('ROLE_ADMIN', 'PRODUCT_UPDATE'), 
                ('ROLE_ADMIN', 'PRODUCT_DELETE'),
                ('ROLE_ADMIN', 'DELIVERY_READ'), 
                ('ROLE_ADMIN', 'DELIVERY_CREATE'), 
                ('ROLE_ADMIN', 'DELIVERY_UPDATE'), 
                ('ROLE_ADMIN', 'DELIVERY_DELETE'),
                ('ROLE_ADMIN', 'PAYMENT_READ'), 
                ('ROLE_ADMIN', 'PAYMENT_CREATE'), 
                ('ROLE_ADMIN', 'PAYMENT_UPDATE'), 
                ('ROLE_ADMIN', 'PAYMENT_DELETE'),
                ('ROLE_MANAGER', 'SHOP_READ'),
                ('ROLE_MANAGER', 'PRODUCT_READ'),
                ('ROLE_MANAGER', 'DELIVERY_READ'),
                ('ROLE_MANAGER', 'PAYMENT_READ')
        ");

        if (!$result) {
            echo mysqli_error($this->conn) . PHP_EOL;
        }
    }

    public function rollback()
    {
        $result = mysqli_query($this->conn, "DROP TABLE `rbac_role`");

        if (!$result) {
            echo mysqli_error($this->conn) . PHP_EOL;
        }

        $result = mysqli_query($this->conn, "DROP TABLE `rbac_permission`");

        if (!$result) {
            echo mysqli_error($this->conn) . PHP_EOL;
        }
        
        $result = mysqli_query($this->conn, "DROP TABLE `rbac_access`");

        if (!$result) {
            echo mysqli_error($this->conn) . PHP_EOL;
        }
    }
}