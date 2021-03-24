<?php

include_once __DIR__ . "/AbstractController.php";
include_once __DIR__ . "/../../../common/src/Model/Permission.php";

class PermissionController extends AbstractController
{
    public function save ()
    {
        if(!empty($_POST)) {
            $product = new Permission (htmlspecialchars($_POST['permission']));

            $product->save();
        }

        return $this->read();
    }

    public function read()
    {
        $all = (new Permission())->all();

        include_once __DIR__ . "/../../views/permission/list.php";
    }
    
    public function update()
    {
        
    }

    public function create()
    {
        include_once __DIR__ . "/../../views/permission/form.php";
    }
    
    public function delete()
    {
        $name = htmlspecialchars($_GET['permission']);
        (new Permission())->deleteByName($name);

        return $this->read();
    }
}