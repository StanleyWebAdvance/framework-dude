<?php

namespace core\console;

class Console
{
    public function __construct($arguments)
    {
        if (method_exists($this, $arguments[1])) {

            $this->$arguments[1]();
            return true;
        }

        $this->parseCommand($arguments);
        return true;
    }

    public function parseCommand($arguments)
    {
        $argsArr = explode(':', $arguments[1]);

        if ($argsArr[0] != 'make') {

            $this->help();
            return true;
        }

        switch ($argsArr[1]) {

            case "Controller" :

                CreateFile::createController($arguments[2]);

//                $this->createController($arguments[2]);
                echo ' done';
                break;

            case "Model" :
                CreateFile::createModel($arguments[2]);
                echo ' done';
                break;

            case "Request" :
                CreateFile::createRequest($arguments[2]);
                echo ' done';
                break;

            case "Middleware" :
                CreateFile::createMiddleware($arguments[2]);
                echo ' done';
                break;

            default :
                $this->help();
                break;
        }
        return true;
    }

    private static function sayHello()
    {
        echo 'Hello word!';
        return true;
    }

    private static function info()
    {
        echo 'Web-developer : Stanley and Ivan 21 august 2018';
        return true;
    }

    private function help()
    {
       Help::Help();
    }
}