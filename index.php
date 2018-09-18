<?php

//  Start point

spl_autoload_register(function ($class) {

    include_once __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
});

session_start();

require __DIR__ . '/vendor/autoload.php';

$exception = new \core\exception\ErrorHandler();
$exception->register();

include_once __DIR__ .  "/routes/web.php";