<?php

//  Start point

spl_autoload_register();

session_start();

require __DIR__ . '/vendor/autoload.php';

(new \core\exception\ErrorHandler())->register();

//\helpers\Debug::dump(   \core\config\Config::storage('image') );



include_once __DIR__ .  "/routes/web.php";