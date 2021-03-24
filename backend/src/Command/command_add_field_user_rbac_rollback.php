<?php

include_once __DIR__ . "/../../../common/src/Service/DBConnector.php";
include_once __DIR__ . "/../Migrations/202105031415_migration_add_rbac.php";

$dbConnector = DBConnector::getInstance();
$migration = new MigrationAddRbac($dbConnector);
$migration->rollback();

die('OK');