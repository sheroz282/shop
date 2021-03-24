<?php

include_once __DIR__ . "/../Service/DBConnector.php";
include_once __DIR__ . "/AbstractModel.php";

class Product extends AbstractModel
{
	const NUMBER_PRODUCTS_PER_PAGE = 20;
	
    public $id;
    public $title;
    public $picture;
    public $preview;
    public $content;
    public $price;
    public $status;
    public $created;
    public $updated;

    public function __construct(
		$id = null, 
		$title = null, 
		$picture = null, 
		$preview = null, 
		$content = null, 
		$price = null, 
		$status = null, 
		$created = null, 
		$updated = null)
    {

		parent::__construct();
		
    	$this->id = $id;
    	$this->title = $title;
    	$this->picture = $picture;
    	$this->preview = $preview;
    	$this->content = $content;
    	$this->price = $price;
    	$this->status = $status;
    	$this->created = $created;
    	$this->updated = $updated;
    }

    public function save()
    {
	    if ($this->id > 0) {
	        $query = "UPDATE products SET
	            title = '" . $this->title . "',
	            preview = '" . $this->preview . "'," .
	            ((!empty($this->picture)) ? "picture='" . $this->picture . "'," : "")
	            . "content = '" . $this->content . "',
	            price = '" . $this->price . "',
	            status = '" . $this->status . "',
	            updated = '" . $this->updated . "'
				where id =" . $this->id . " limit 1";
	    } else {
	        $query = "INSERT INTO products VALUES (
	            null,
	            '" . $this->title . "',
	            '" . $this->picture . "',
	            '" . $this->preview . "',
	            '" . $this->content . "',
	            '" . $this->price . "',
	            '" . $this->status . "',
	            '" . $this->created . "',
	            '" . $this->updated . "'
	        )";
	    }
	   $result = mysqli_query($this->conn, $query);
	}
	
	public function all($categoryIds = [], $limit = self::NUMBER_PRODUCTS_PER_PAGE, $offset = 0)
	{
		$where = !empty($categoryIds) && is_array($categoryIds) ? 'WHERE cp.category_id IN (' . implode(',', $categoryIds) . ')' : '' ;
		
		 $query = "SELECT * FROM products WHERE id IN (SELECT
			products.id
			FROM 
			products
			left join category_product cp on products.id = cp.product_id
			$where)
			order by id desc limit $offset, $limit";
		
		$result = mysqli_query($this->conn, $query);
		
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
	}

	public function getNumberPage($categoryIds = [], $limit = self::NUMBER_PRODUCTS_PER_PAGE)
	{
			$where = !empty($categoryIds) && is_array($categoryIds) ? ' WHERE cp.category_id IN (' . implode(',', $categoryIds) . ')' : '' ;
		
		$query = "SELECT 
			count(*)
			FROM 
			products $where";
		
		$result = mysqli_query($this->conn, $query);
		
		$result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $number = reset($result);
		$number = reset($number);
		
		return floor($number/Product::NUMBER_PRODUCTS_PER_PAGE);
	}
	
	public function getById($id)
	{
		$result = mysqli_query($this->conn , "SELECT * FROM products WHERE id = $id LIMIT 1");
        $one = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return reset($one);
	}

	public function deleteById($id)
	{
        mysqli_query($this->conn , "DELETE FROM products WHERE id = $id LIMIT 1");
	}
}