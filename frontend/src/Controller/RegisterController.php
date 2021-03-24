<?php

include_once __DIR__ . "/../../../common/src/Model/User.php";
include_once __DIR__ . "/../../../common/src/Service/SecurityService.php";

class RegisterController
{
    public function register()
    {
        if (empty($_POST) || empty($_POST['name']) || empty($_POST['phone']) || empty($_POST['email']) 
            || empty($_POST['password']) || empty($_POST['password_repeat'])) {
                throw new Exception('BAD REQUEST', 400);
            }

        if ($_POST['password_repeat'] !== $_POST['password']) {
            throw new Exception('password not equals', 400);
        }

        if (!empty($_POST)) {
            $user = new User(
                (int) ($_POST['id'] ?? null),
                htmlspecialchars($_POST['name']),
                htmlspecialchars($_POST['phone']),
                htmlspecialchars($_POST['email']),
                htmlspecialchars($_POST['password']),
                [User::ROLE_USER_VALUE]
            );

            $user->save();

            SecurityService::redirectToLoginPage();
        }
    }

    public function form()
    {
        include_once __DIR__ . "/../../views/register/form.php";
    }
}