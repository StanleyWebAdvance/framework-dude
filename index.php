<?php

//  Start point

spl_autoload_register();

session_start();

require __DIR__ . '/vendor/autoload.php';

(new \core\exception\ErrorHandler())->register();

include_once __DIR__ .  "/routes/web.php";