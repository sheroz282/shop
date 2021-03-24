<?php

include_once __DIR__ . "/../../../common/src/Service/DBConnector.php";
include_once __DIR__ . "/../Fixtures/FixtureCategoryProduct.php";

$dbConnector = DBConnector::getInstance();
$fixture = new FixtureCategoryProduct($dbConnector);
$fixture->run();

die('OK');