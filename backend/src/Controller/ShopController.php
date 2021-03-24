<?php

include_once __DIR__ . "/AbstractController.php";
include_once __DIR__ . "/../../../common/src/Model/Shop.php";

class ShopController extends AbstractController
{
    public function save ()
    {
        if(!empty($_POST)){
            $product = new Shop (
                intval($_POST['id']), 
                htmlspecialchars($_POST['title']),
                htmlspecialchars($_POST['address'])
            );
            $product->save();
        }

        return $this->read();
    }
    public function read()
    {
        $all = (new Shop())->all();

        include_once __DIR__ . "/../../views/shop/list.php";
    }
    public function create()
    {
        include_once __DIR__ . "/../../views/shop/form.php";
    }
    public function update()
    {
        $id = (int)$_GET['id'];
        if (empty($id)) die('u id');
        $one = (new Shop())->getById($id);
        if (empty($one)) die('p u id');

        include_once __DIR__ . "/../../views/shop/form.php";
    }
    public function delete()
    {
        $id = (int)$_GET['id'];
        (new Shop())->deleteById($id);

        return $this->read();
    }
}