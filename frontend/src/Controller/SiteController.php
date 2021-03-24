<?php

include_once __DIR__ . "/../../../common/src/Model/Product.php";
include_once __DIR__ . "/../../../common/src/Service/UserService.php";

class SiteController 
{
    public function index()
    {
        $all = (new Product())->all();

        include_once __DIR__ . "/../../views/site/index.php";
    }

    public function login()
    {
        include_once __DIR__ . "/../../views/site/login.php";
    }
}