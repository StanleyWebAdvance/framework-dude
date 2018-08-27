<?php

namespace core\console;

class CreateFile
{

    public static function createController($name)
    {
        echo $name . ' - Controller ';
    }

    public static function createModel($name)
    {
        echo $name . ' - Model ';
    }

    public static function createRequest($name)
    {
        echo $name . ' - Request ';
    }

    public static function createMiddleware($name)
    {
        echo $name . ' - Middleware ';
    }

}