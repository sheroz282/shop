<?php

session_start();

$side = "backend";

include_once __DIR__ . "/../common/src/Service/Router.php";

$router = new Router('backend');

$router->index();