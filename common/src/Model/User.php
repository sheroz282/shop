<?php

include_once __DIR__ . "/../Service/UserService.php";
include_once __DIR__ . "/../Service/DBConnector.php";

class User
{
    const ROLE_USER_VALUE = 'ROLE_USER';

    /**
     * @var int
     */
    private $id;

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
     * @var string
     */
    private $password;

    /**
     * @var array
     */
    private $roles;

    private $conn;

    public function __construct(
		$id = null, 
		$name = null, 
		$phone = null, 
		$email = null, 
		$password = null, 
		$roles = []
    )
    {
    	$this->conn = DBConnector::getInstance()->connect();

    	$this->setId($id);
    	$this->setName($name);
    	$this->setPhone($phone);
    	$this->setEmail($email);
    	$this->setPassword($password);
    	$this->setRoles($roles);
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = UserService::encodePassword($password);
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    public function save()
    {
	    if ($this->id > 0) {
	        $query = "UPDATE `user` SET
	            `name`='" . $this->getName() . "',
	            `phone`='" . $this->getPhone() . "', .
	            `password`='" . $this->getPassword() . "', .
	            `roles`='" . json_encode($this->getRoles()) . "', .
	            `email`='" . $this->getEmail() . "'
	            where id=" . $this->id . " limit 1";
	    } else {
	        $query = "INSERT INTO `user` (`id`, `name`, `phone`, `email`, `password`, `roles`) VALUES (
	            null,
	            '" . $this->getName() . "',
	            '" . $this->getPhone() . "',
	            '" . $this->getEmail() . "',
	            '" . $this->getPassword() . "',
	            '" . json_encode($this->getRoles()) . "')";
	    }

	    $result = mysqli_query($this->conn, $query);

        if (!$result) {
            throw new Exception(mysqli_error($this->conn), 400);
        }
	}

    /**
     * @param $id
     * @return mixed
     */
	public function getById($id)
	{
		$result = mysqli_query($this->conn , "SELECT * FROM `user` WHERE id = " . $id . " LIMIT 1");
        $one = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return reset($one);
	}

    /**
     * @param $email
     * @return mixed
     * @throws Exception
     */
	public function getByEmail($email)
	{
		$result = mysqli_query($this->conn , "SELECT * FROM `user` WHERE `email` = '" . $email . "' LIMIT 1");

        if (!$result) {
            throw new Exception("User not found", 404);
        }

        $one = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return reset($one);
	}

    public function isAccess(array $roles, $controller, $action)
    {
        $permission = SecurityService::getPermissionNameByControllerAndAction($controller, $action);

        $result = mysqli_query($this->conn , "SELECT * FROM `rbac_access` 
            WHERE `role` IN ('" . implode("','", $roles) . "') AND permission = '$permission'");

        if (!$result) {
            throw new Exception("Permission Error", 400);
        }

        $accesses = mysqli_fetch_all($result, MYSQLI_ASSOC);

        foreach ($accesses as $access) {
            if ($access) return true;
        }
        
        throw new Exception("NOT Permission", 403);
    }
}