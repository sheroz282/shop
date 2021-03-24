<?php 

class DBConnector
{
    private $connect;
    private static $instance;

    public function __construct(
        $host = "localhost", 
        $user = "root",
        $password = "root", 
        $db= "shop_db")
    {
      $this->connect = mysqli_connect(
          $host, 
          $user,
          $password, 
          $db);
    }

    public function connect()
    {
        return $this->connect;
    }

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}