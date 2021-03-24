<?php

include_once __DIR__ . "/AbstractController.php";
include_once __DIR__ . "/../../../common/src/Model/Delivery.php";

class DeliveryController extends AbstractController
{
    public function save ()
    {
        if(!empty($_POST)){
            $product = new Delivery (
                intval($_POST['id']), 
                htmlspecialchars($_POST['title']),
                htmlspecialchars($_POST['code']),
                (int)($_POST['priority'])
            );
            $product->save();
        }

        return $this->read();
    }
    public function read()
    {
        $all = (new Delivery())->all();

        include_once __DIR__ . "/../../views/delivery/list.php";
    }
    public function create()
    {
        include_once __DIR__ . "/../../views/delivery/form.php";
    }
    public function update()
    {
        $id = (int)$_GET['id'];
        if (empty($id)) die('u id');
        $one = (new Delivery())->getById($id);
        if (empty($one)) die('p u id');

        include_once __DIR__ . "/../../views/delivery/form.php";
    }
    public function delete()
    {
        $id = (int)$_GET['id'];
        (new Delivery())->deleteById($id);

        return $this->read();
    }
}