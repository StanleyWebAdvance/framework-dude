<?php

include_once "routes/web.php";

function __autoload($classname) {
    include_once __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
}




/* -----  test  ---- */


use core\DBConnector;
use config\Config;
use core\Request;
use app\controllers\PageController;

$request = new Request();
$config = new Config('.env');

$page = new PageController();

//\helpers\Helpers::dump($page->index());
//\helpers\Helpers::dump(DBConnector::getInstance());