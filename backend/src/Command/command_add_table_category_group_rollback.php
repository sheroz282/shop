<?php

include_once __DIR__ . "/../../../common/src/Service/DBConnector.php";
include_once __DIR__ . "/../Migrations/202103211753_migration_add_category_group.php";

$dbConnector = DBConnector::getInstance();
$migration = new MigrationAddCategoryCroup($dbConnector);
$migration->rollback();

die('OK');