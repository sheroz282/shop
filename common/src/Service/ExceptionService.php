<?php

class ExceptionService
{
    public static function error(Exception $e, $side)
    {
        http_response_code($e->getCode());

        error_log( "Exception: " . $e->getMessage() . "file = ProductController.php:18" );
        $code = $e->getCode();
        $message = $e->getMessage();

        include_once __DIR__ . "/../../../$side/views/exceptions/400.php";
    }
}