<?php

include_once __DIR__ . "/../Service/DBConnector.php";

class BasketItem
{
    public $basketId;
    public $productId;
    public $quantity;

    private $conn;

    public function __construct(
        $basketId = null,
        $productId = null,
        $quantity = null
    )
    {
    	$this->conn = DBConnector::getInstance()->connect();
    	$this->basketId = $basketId;
        $this->productId = $productId;
        $this->quantity = $quantity;
    }

    public function setConn($testConn)
    {
        $this->conn = $testConn;

        return $this;
    }

    public function save()
    {
        $query = "INSERT INTO basket_item VALUES ( null, '" . $this->basketId . "', '" . $this->productId . "', '" . $this->quantity . "')";
	    
        $result = mysqli_query($this->conn, $query);

	    if (!$result) {
	        throw new Exception(mysqli_error($this->conn));
        }
	}

    public function update()
    {
        if (empty($this->basketId) || empty($this->productId) || empty($this->quantity)) {
            throw new Exception("Empty basket item field");
        }

        $query = "UPDATE basket_item SET quantity = " . $this->quantity 
            . " WHERE basket_id = " . $this->basketId 
            . " AND product_id = " . $this->productId 
            . " LIMIT 1";
            
	    $result = mysqli_query($this->conn, $query);

	    if (!$result) {
	        throw new Exception( mysqli_error($this->conn));
        }
	}

	public function getByBasketId($basketId)
	{
		$result = mysqli_query($this->conn , "SELECT * FROM basket_item WHERE basket_id = $basketId");
        $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        return $items;
	}

	public function deleteProductByBasketId($productId, $basketId)
	{
        mysqli_query($this->conn , "DELETE FROM basket_item WHERE product_id = $productId AND basket_id = $basketId LIMIT 1");
	}

    public function clearByBasketId($basketId)
	{
        mysqli_query($this->conn , "DELETE FROM basket_item WHERE basket_id = $basketId");
	}
}