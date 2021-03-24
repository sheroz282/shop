<?php

include_once __DIR__ . "/../Model/Category.php";

class CategoryService
{
    const GENRE_GROUP_ID = 1;

    public static function getGenre()
    {
        return (new Category())->getByGroupIds([self::GENRE_GROUP_ID]);
    }

    public static function getCategoriesForSidebar()
    {
        return (new Category())->getGroupsWithCategories([self::GENRE_GROUP_ID]);
    }
}
?>