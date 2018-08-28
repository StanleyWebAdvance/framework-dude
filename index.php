<?php

/**
 *      starting point
 */




spl_autoload_register();

session_start();

require __DIR__ . '/vendor/autoload.php';

(new \core\exception\ErrorHandler())->register();

include_once __DIR__ .  "/routes/web.php";


//\helpers\Debug::dd($_SERVER);




/* -----  test  ---- */

//function __autoload($classname) {
//    include_once __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
//}

//$console = new Console(array('qq', 'make:Model'));
//
//\helpers\Debug::dump($console);

//$request = new Request();
//$config = new Config('.env');
//
//$page = new PageController();

//\helpers\Helpers::dump($page->index());
//\helpers\Helpers::dump(DBConnector::getInstance());