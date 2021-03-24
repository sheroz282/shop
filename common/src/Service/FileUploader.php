<?php

class FileUploader
{
    public static function upload($folder)
    {
        if(!empty($_FILES['picture']['tmp_name'])){
            $filename = md5(rand(10000,99999) . microtime()) . $_FILES['picture']['name'];

            copy($_FILES['picture']['tmp_name'], __DIR__ . '/../../../uploads/' . $folder . '/'
                 . $filename);

            return $filename;
            }

            return null;
    }
}