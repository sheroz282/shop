<?php

include_once __DIR__ . "/../../../common/src/Service/DBConnector.php";
include_once __DIR__ . "/../Migrations/202001011753_migration_add_field_city_to_shops.php";

$dbConnector = DBConnector::getInstance();
$migration = new MigrationAddFieldCityToShops($dbConnector);
$migration->commit();

die('OK');