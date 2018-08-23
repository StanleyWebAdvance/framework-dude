<?php

spl_autoload_register();

require __DIR__ . '/vendor/autoload.php';

include_once __DIR__ .  "/routes/web.php";



//function __autoload($classname) {
//    include_once __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
//}






/* -----  test  ---- */



use config\Config;
use core\Request;
use app\controllers\PageController;
use core\Console;

//$console = new Console(array('qq', 'make:Model'));
//
//\helpers\Debug::dump($console);

//$request = new Request();
//$config = new Config('.env');
//
//$page = new PageController();

//\helpers\Helpers::dump($page->index());
//\helpers\Helpers::dump(DBConnector::getInstance());