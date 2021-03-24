<?php

class MigrationAddCategoryCroup {

    private $conn;

    public function __construct(DBconnector $connector)
    {
        $this->conn = $connector->connect();
    }

    public function commit()
    {
        $result = mysqli_query($this->conn, "CREATE TABLE category_group (
            id INT NOT NULL AUTO_INCREMENT,
            title VARCHAR (64) NOT NULL,
            PRIMARY KEY (id)
            ) ENGINE = INNODB DEFAULT CHARSET 'utf8';");

        if (!$result) {
            echo mysqli_error($this->conn) . PHP_EOL;
        }

        $result = mysqli_query($this->conn, "INSERT INTO `category_group` (`title`) VALUES ('Жанр'),
            ('Топ 100'), ('Авторы'), ('Часто покупаемые'), ('Год издания')");

        if (!$result) {
            echo mysqli_error($this->conn) . PHP_EOL;
        }

        $result = mysqli_query($this->conn, "INSERT INTO `categories` (`title`, `group_id`, `parent_id`, `prior`) 
            VALUES ('Комедии', '1', '0', '100'),
            ('Детективы', '1', '0', '90'), ('Фантастика', '1', '0', '80'), ('Драма', '1', '0', '70'),
            ('Научные', '1', '0', '60'), ('Исторические', '1', '0', '50'), ('Биснес', '1', '0', '1000'),
            ('За 2020 год', '2', '0', '100'), ('За текущий год', '2', '0', '90'), 
            ('За 20 столетие', '2', '0', '80'), ('Бил Мартин', '3', '0', '100'), ('Джемс Хериот', '4', '0', '90'),
            ('Тими Ченчез', '3', '0', '80'), ('Комедии', '4', '0', '100'), ('Детективы', '4', '0', '100'),
            ('Детские', '4', '0', '90'), ('1800-1900', '5', '0', '100'),
            ('1900-2000', '5', '0', '100'), ('21 век', '5', '0', '200'),('Детские', '1', '0', '100'),
			('Духовная','1', '0', '30')");

        if (!$result) {
            echo mysqli_error($this->conn) . PHP_EOL;
        }
		
		 $result = mysqli_query($this->conn, "create table category_product(
				product_id int not null,
				category_id int not null
			 )engine = innodb");

        if (!$result) {
            echo mysqli_error($this->conn) . PHP_EOL;
        }
    }

    public function rollback()
    {
        $result = mysqli_query($this->conn, "DROP TABLE category_group");

        if (!$result) {
            echo mysqli_error($this->conn) . PHP_EOL;
        }

        $result = mysqli_query($this->conn, "TRUNCATE TABLE categories");

        if (!$result) {
            echo mysqli_error($this->conn) . PHP_EOL;
        }
		
		$result = mysqli_query($this->conn, "DROP TABLE category_product");

        if (!$result) {
            echo mysqli_error($this->conn) . PHP_EOL;
        }
    }
}