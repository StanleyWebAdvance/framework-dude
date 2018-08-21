<?php

include_once "routes/web.php";

use config\database;
use core\DBConnector;

function __autoload($classname) {
    include_once __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
}


$daa = new database();

\helpers\Helpers::dump(DBConnector::getInstance());