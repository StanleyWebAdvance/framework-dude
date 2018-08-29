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

        if ($argsArr[0] != 'make' || $arguments[2] == null) {

            $this->help();
            return true;
        }
        
        switch (mb_strtolower($argsArr[1])) {

            case "controller" :
                File::create('Controller', 'app/controllers', $arguments[2]);
                echo 'done';
                break;

            case "model" :
                File::create("Model", 'app/models', $arguments[2]);
                echo 'done';
                break;

            case "request" :
                File::create("Request", 'app/requests', $arguments[2]);
                echo 'done';
                break;

            case "middleware" :
                File::create("Middleware", 'app/middleware', $arguments[2]);
                echo 'done';
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