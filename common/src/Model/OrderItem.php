<?php

include_once __DIR__ . "/../Service/DBConnector.php";

class OrderItem
{
    public $orderId;
    public $productId;
    public $quantity;

    private $conn;

    public function __construct(
        $orderId = null,
        $productId = null,
        $quantity = null
    )
    {
    	$this->conn = DBConnector::getInstance()->connect();
    	$this->orderId = $orderId;
        $this->productId = $productId;
        $this->quantity = $quantity;
    }

    public function setConn($conn)
    {
        $this->conn = $conn;

        return $this;
    }

    public function save()
    {
        $query = "INSERT INTO order_item VALUES ( null, '" . $this->orderId . "', '"
         . $this->productId . "', '" . $this->quantity . "')";
	    
        $result = mysqli_query($this->conn, $query);

	    if (!$result) {
	        throw new Exception(mysqli_error($this->conn));
        }
	}

    public function update()
    {
        if (empty($this->orderId) || empty($this->productId) || empty($this->quantity)) {
            throw new Exception("Empty order item field");
        }

        $query = "UPDATE order_item SET quantity = " . $this->quantity 
            . " WHERE order_id = " . $this->orderId 
            . " AND product_id = " . $this->productId 
            . " LIMIT 1";
            
	    $result = mysqli_query($this->conn, $query);

	    if (!$result) {
	        throw new Exception( mysqli_error($this->conn));
        }
	}

	public function getByBasketId($orderId)
	{
		$result = mysqli_query($this->conn , "SELECT * FROM order_item WHERE order_id = $orderId");
        $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        return $items;
	}

	public function deleteProductByOrderId($productId, $orderId)
	{
        mysqli_query($this->conn , "DELETE FROM order_item WHERE product_id = $productId AND order_id = $orderId LIMIT 1");
	}

    public function clearByBasketId($orderId)
	{
        mysqli_query($this->conn , "DELETE FROM order_item WHERE order_id = $orderId");
	}
}