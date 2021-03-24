<?php

include_once __DIR__ . "/UserService.php";

class SecurityService
{
    public function checkPassword($user, $password)
    {
        if (empty($user)) {
            throw new Exception('User not found', 404);
        }

        if (UserService::encodePassword($password) !== $user['password']) {
            throw new Exception('Incorrect password', 400);
        }

        return true;
    }

    public static function redirectToStartPage()
    {
        global $side;
        header("location: /" . $side . "/index.php");
        die();
    }

    public static function redirectToLoginPage()
    {
        global $side;
        header("location: /" . $side . "/index.php?model=site&action=login");
        die();
    }

    public static function isAuthorized()
    {
        if (empty(UserService::getCurrentUser())) return false;

        return true;
    }

    public static function getPermissionNameByControllerAndAction($controller, $action)
    {
        return strtoupper($controller) . '_' . strtoupper($action);
    }
}