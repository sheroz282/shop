<?php

include_once __DIR__ . "/../Service/DBConnector.php";

class Delivery
{
    public $id;
    public $title;
    public $code;
    public $priority;

    private $conn;

    public function __construct($id = null, $title = null, $code = null, $priority = null)
    {
    	$this->conn = DBConnector::getInstance()->connect();

    	$this->id = $id;
    	$this->title = $title;
    	$this->code = $code;
    	$this->priority = $priority;
    }

    public function save()
    {
	    if ($this->id > 0) {
	        $query = "UPDATE delivery SET
	            title = '" . $this->title . "',
	            code = '" . $this->code . "',
	            priority = '" . $this->priority . "'
	        where id = $this->id limit 1";
	    } else {
	        $query = "INSERT INTO delivery VALUES (
	            null,
	            '" . $this->title . "',
	            '" . $this->code . "',
	            '" . $this->priority . "'
	        )";
	    }
	    mysqli_query($this->conn, $query);
	}
	
	public function all()
	{
		$result = mysqli_query($this->conn , "SELECT * FROM delivery ORDER BY id DESC");
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
	}

	public function getById($id)
	{
		$result = mysqli_query($this->conn , "SELECT * FROM delivery WHERE id = $id LIMIT 1");
        $one = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return reset($one);
	}

	public function deleteById($id)
	{
        mysqli_query($this->conn , "DELETE FROM delivery WHERE id = $id LIMIT 1");
	}
}