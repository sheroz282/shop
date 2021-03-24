<?php

include_once __DIR__ . "/../Service/DBConnector.php";
include_once __DIR__ . "/../Model/Product.php";

class Order
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @var int|null
     */
    private $userId;

    /**
     * @var int
     */
    private $deliveryId;

    /**
     * @var int
     */
    private $paymentId;

    /**
     * @var int
     */
    private $total;

    /**
     * @var int
     */
    private $status;

    /**
     * @var datetime
     */
    private $created;

    /**
     * @var datetime
     */
    private $updated;

    /**
     * @var string|null
     */
    private $comment;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $email;

    /**
     * @var mysqli
     */
    private $conn;

    /**
     * Order constructor
     * @param int|null $id
     * @param int|null $userId
     * @param int $paymentId
     * @param int $deliveryId
     * @param int $status
     * @param int $updated
     * @param string $comment
     * @param string $name
     * @param string $phone
     * @param string $email
     * @param string $total
     */
    public function __construct(
        $id = null, 
        $userId = null, 
        $paymentId = null, 
        $deliveryId = null,
        $total = null,
        $comment = null, 
        $name = null, 
        $phone = null, 
        $email = null, 
        $status = null, 
        $updated = null
    )
    {
    	$this->conn = DBConnector::getInstance()->connect();
    	$this->id = $id;
    	$this->userId = $userId;
    	$this->paymentId = $paymentId;
    	$this->deliveryId = $deliveryId;
    	$this->total = $total;
    	$this->status = $status;
    	$this->comment = $comment;
    	$this->name = $name;
    	$this->email = $email;
    	$this->phone = $phone;
        if ($this->id == null) {
    	    $this->created = date('Y-m-d H:i:s', time());
        }
    	$this->updated = $updated ?? date('Y-m-d H:i:s', time());
    }

    /**
     * @param int $status
     */
    public function setStatus($stutus)
    {
        $this->status = $stutus;
    }

    /**
     * @return int|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int|null $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getDeliveryId()
    {
        return $this->deliveryId;
    }

    /**
     * @param int $deliveryId
     */
    public function setDeliveryId($deliveryId)
    {
        $this->deliveryId = $deliveryId;
    }

    /**
     * @return int
     */
    public function getPaymentId()
    {
        return $this->paymentId;
    }
    
    /**
     * @param int $paymentId
     */
    public function setPaymentId($paymentId)
    {
        $this->paymentId = $paymentId;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }
    
    /**
     * @param int $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * @return string|null
     */
    public function getComment()
    {
        return $this->comment;
    }
    
    /**
     * @param string|null $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }
    
    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getConn()
    {
        return $this->conn;
    }
    
    /**
     * @param string $conn
     */
    public function setConn($conn)
    {
        $this->conn = $conn;

        return $this;
    }

    /**
     * @return datetime
     */
    public function getCreated()
    {
        return $this->created;
    }
    
    /**
     * @param datetime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return datetime
     */
    public function getUpdated()
    {
        return $this->updated;
    }
    
    /**
     * @param datetime $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    /**
     * @throws Exception
     */
    public function save()
    {
        $query = "INSERT INTO orders (
            id, 
            user_id, 
            status, 
            created, 
            updated, 
            delivery_id, 
            payment_id, 
            total, 
            comment,
            name, 
            email, 
            phone) 
            VALUES (null, '" . $this->userId . "', '" . $this->status . "', '" . $this->created 
            . "', '" . $this->updated . "', '" . $this->deliveryId . "', '" . $this->paymentId
            . "', '" . $this->total . "', '" . $this->comment . "', '" . $this->name
            . "', '" . $this->email . "', '" . $this->phone . "')";

	    $result = mysqli_query($this->conn, $query);

	    if (!$result) {
	        throw new Exception(mysqli_error($this->conn));
        }

        $result = mysqli_query($this->conn, "SELECT LAST_INSERT_ID() as last_id");
        
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return reset($result)['last_id'] ?? null;
	}

    /**
     * @return bool
     * @throws Exception
     */
    public function update()
    {
        $query = "UPDATE orders SET status = '" . $this->status . "', updated = '" . $this->updated . "', 
            delivery_id = '" . $this->deliveryId . "', payment_id = '" . $this->paymentId
            . "', total = '" . $this->total . "', name = '" . $this->name
            . "', email = '" . $this->email . "', phone = '" . $this->phone . "' WHERE id = '" . $this->id . "' limit 1";

	    $result = mysqli_query($this->conn, $query);

	    if (!$result) {
	        throw new Exception(mysqli_error($this->conn));
        }

        return true;
	}

    /**
     * @return array<Order>
     */
	public function getFromDB()
	{
		$result = mysqli_query($this->conn , "SELECT * FROM orders WHERE user_id = " 
            . $this->userId . " LIMIT 1");
        $one = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return reset($one);
	}

    /**
     * @return array<Order>
     */
	public function all()
	{
		$result = mysqli_query($this->conn , "SELECT * FROM orders");

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
	}

    /**
     * @return array
     */
	public function getById($id)
	{
		$result = mysqli_query($this->conn , "SELECT * FROM orders WHERE id = " . $id . " LIMIT 1");
        $one = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return reset($one);
	}

    public function getProductsAndQuantityByOrderId($orderId)
    {
        $products = [];

		$result = mysqli_query($this->conn , "SELECT 
                    order_item.quantity,
                    products. *
                    FROM
                    order_item
                    LEFT JOIN products ON order_item.product_id = products.id
                    WHERE order_id = " . $orderId);
        foreach (mysqli_fetch_all($result, MYSQLI_ASSOC) as $item) {
            $products[] = [
                'quantity' => $item['quantity'],
                'product' => new Product($item['id'], $item['title'], $item['picture'], $item['preview'],
                    $item['contend'], $item['price'], $item['status'], $item['created'], $item['updated'])
            ];
        }

        return $products;
    }
}
