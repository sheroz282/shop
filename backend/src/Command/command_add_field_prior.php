<?php

include_once __DIR__ . "/../../../common/src/Service/DBConnector.php";
include_once __DIR__ . "/../Migrations/202001011753_migration_add_field_prior_to_categories.php";

$dbConnector = DBConnector::getInstance();
$migration = new migrationAddFieldPriorToCategory($dbConnector);
$migration->commit();

die('OK');