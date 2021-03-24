<?php
include_once __DIR__ . "/../Service/DBConnector.php";

class Comments
{
    public $id;
    public $productId;
    public $username;
    public $email;
    public $avatar;
    public $text;
    public $created;

    private $conn;

    public function __construct(
		$id = null, 
		$productId = null,  
		$username = null,
		$email = null,
		$avatar = null,
		$text = null)
    {
    	$this->conn = DBConnector::getInstance()->connect();

    	$this->id = $id;
    	$this->productId = $productId;
    	$this->username = $username;
    	$this->email = $email;
    	$this->avatar = $avatar;
    	$this->text = $text;
    	$this->created = date('Y-m-d H:i:s', time());
    }

    public function save()
    {
	        $query = "INSERT INTO comments VALUES (
	            null,
	            '" . $this->productId . "',
	            '" . $this->username . "',
	            '" . $this->email . "',
	            '" . $this->avatar . "',
	            '" . $this->text . "',
	            '" . $this->created . "'
	        )";
	   
	    $result = mysqli_query($this->conn, $query);
		
		if(!$result){
			throw new Exception(mysqli_error($this-conn), 400);
		}
	}
	
	public function all()
	{
		$result = mysqli_query($this->conn , "SELECT * FROM comments ORDER BY id DESC");
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
	}

	public function getByProductId($productId)
	{
		$result = mysqli_query($this->conn , "SELECT * FROM comments WHERE product_id = $productId ");
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
	}

	public function deleteById($id)
	{
        mysqli_query($this->conn , "DELETE FROM comments WHERE id = $id LIMIT 1");
	}
}