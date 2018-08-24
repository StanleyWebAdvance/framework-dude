<?php

namespace core;

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

    private function parseCommand($arguments)
    {
        $argsArr = explode(':', $arguments[1]);

        if ($argsArr[0] != 'make') {

            $this->help();
            return true;
        }

        switch ($argsArr[1]) {

            case "Controller" :
                $this->createController($arguments[2]);
                echo ' done';
                break;

            case "Model" :
                $this->createModel($arguments[2]);
                echo ' done';
                break;

            case "Request" :
                $this->createRequest($arguments[2]);
                echo ' done';
                break;

            default :
                $this->help();
                break;
        }
        return true;
    }








    //todo почему-то не могу вынести методы в другой класс пишет Фатал нет класса

    protected function createController($name)
    {
        echo $name . ' - Controller ';
    }

    protected function createModel($name)
    {
        echo $name . ' - Model ';
    }

    protected function createRequest($name)
    {
        echo $name . ' - Request ';
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
        echo '
              HELP: ---  make:{Controller/Model/Request} {Name}
              ';
    }
}