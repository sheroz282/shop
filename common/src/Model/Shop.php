<?php

include_once __DIR__ . "/../Service/DBConnector.php";

class Shop
{
    public $id;
    public $title;
    public $address;

    private $conn;

    public function __construct(
		$id = null, 
		$title = null, 
		$address = null)
    {
    	$this->conn = DBConnector::getInstance()->connect();

    	$this->id = $id;
    	$this->title = $title;
    	$this->address = $address;
    }

    public function save()
    {
	    if ($this->id > 0) {
	        $query = "UPDATE shops SET
	            title = '" . $this->title . "',
	            address = '" . $this->address . "'
	        where id = $this->id limit 1";
	    } else {
	        $query = "INSERT INTO shops VALUES (
	            null,
	            '" . $this->title . "',
	            '" . $this->address . "'
	        )";
	    }
	    mysqli_query($this->conn, $query);
	}
	
	public function all()
	{
		$result = mysqli_query($this->conn , "SELECT * FROM shops ORDER BY id DESC");
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
	}

	public function getById($id)
	{
		$result = mysqli_query($this->conn , "SELECT * FROM shops WHERE id = $id LIMIT 1");
        $one = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return reset($one);
	}

	public function deleteById($id)
	{
        mysqli_query($this->conn , "DELETE FROM shops WHERE id = $id LIMIT 1");
	}
}