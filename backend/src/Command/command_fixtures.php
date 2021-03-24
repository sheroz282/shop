<?php

include_once __DIR__ . "/../Fixtures/Fixture01.php";
include_once __DIR__ . "/../Fixtures/Fixture02.php";
include_once __DIR__ . "/../Fixtures/Fixture03.php";
include_once __DIR__ . "/../Fixtures/Fixture04.php";
include_once __DIR__ . "/../../../common/src/Service/DBConnector.php";

$fixture = new Fixture01 (DBConnector::getInstance());
$fixture->run();

$fixture = new Fixture02 (DBConnector::getInstance());
$fixture->run();

$fixture = new Fixture03 (DBConnector::getInstance());
$fixture->run();

$fixture = new Fixture04 (DBConnector::getInstance());
$fixture->run();

die ("OK");
