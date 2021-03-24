<?php

include_once __DIR__ . "/AbstractController.php";
include_once __DIR__ . "/../../../common/src/Model/Category.php";

class CategoryController extends AbstractController
{
    public function save ()
    {
        if(!empty($_POST)){
            $product = new Category (
                intval($_POST['id']), 
                htmlspecialchars($_POST['title']), 
                (int)($_POST['group_id']), 
                (int)($_POST['parent_id'])
            );
            $product->save();
        }

        return $this->read();
    }
    public function read()
    {
        $all = (new Category())->all();

        include_once __DIR__ . "/../../views/category/list.php";
    }
    public function create()
    {
        include_once __DIR__ . "/../../views/category/form.php";
    }
    public function update()
    {
        $id = (int)$_GET['id'];
        if (empty($id)) die('u id');
        $one = (new Category())->getById($id);
        if (empty($one)) die('p u id');

        include_once __DIR__ . "/../../views/category/form.php";
    }
    public function delete()
    {
        $id = (int)$_GET['id'];
        (new Category())->deleteById($id);

        return $this->read();
    }
}