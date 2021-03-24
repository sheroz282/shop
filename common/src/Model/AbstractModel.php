<?php

include_once __DIR__ ."/../Service/DBConnector.php";

abstract class AbstractModel 
{
	protected $conn;
	
	public function __construct()
	{
		$this->conn = DBConnector::getInstance()->connect();
	}
}

?>