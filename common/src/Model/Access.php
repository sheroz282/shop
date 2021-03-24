<?php

include_once __DIR__ . "/../Service/DBConnector.php";

class Access
{
    private $conn;

    public function __construct()
    {
    	$this->conn = DBConnector::getInstance()->connect();
    }

    public function createAll(array $data = [])
    {
        if (empty($data)) {
            throw new Exception('Empty Access DATA');
        }

        $accesses = [];
        foreach ($data as $role => $perms) {
            foreach ($perms as $perm => $value) {
                if ($value === 'on') $accesses[] = sprintf("('%s', '%s')", $role, $perm);
            }
        }

        if (empty($accesses)) {
            throw new Exception('Empty DATA for Access Insert');
        }

        $query = "INSERT INTO rbac_access VALUES" . implode(',', $accesses);
        
		$result = mysqli_query($this->conn , $query);
        
        if (!$result) {
            throw new Exception(mysqli_error($this->conn));
        }

        return true;
    }

	public function clear()
	{
		$result = mysqli_query($this->conn , "TRUNCATE TABLE rbac_access");
        
        if (!$result) {
            throw new Exception(mysqli_error($this->conn));
        }

        return true;
	}

	public function all()
	{
		$result = mysqli_query($this->conn , "SELECT * FROM rbac_access");

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
	}
}