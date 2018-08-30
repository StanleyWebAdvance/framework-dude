<?php

namespace core\console;

class Console
{
    const ANSWER_PATH = 'config/console.php';
    private $answer = array();

    public function __construct($arguments)
    {
        $this->answer = include_once self::ANSWER_PATH;

        if (method_exists($this, $arguments[1])) {

            mb_strtolower($arguments[1]);
            $this->$arguments[1]();
            return true;
        }

        $this->parseCommand($arguments);
        return true;
    }

    /**
     *  Парсим имя команды
     *
     * @param $arguments
     * @return bool
     */
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
                echo $this->answer['done'];
                break;

            case "model" :
                File::create("Model", 'app/models', $arguments[2]);
                echo $this->answer['done'];
                break;

            case "request" :
                File::create("Request", 'app/requests', $arguments[2]);
                echo $this->answer['done'];
                break;

            case "middleware" :
                File::create("Middleware", 'app/middleware', $arguments[2]);
                echo $this->answer['done'];
                break;

            default :
                $this->help();
                break;
        }
        return true;
    }

    /**
     * @return bool
     */
    private function hello()
    {
        echo $this->answer['hello'];
        return true;
    }

    /**
     * @return bool
     */
    private function info()
    {
        echo $this->answer['info'];
        return true;
    }

    /**
     *  Подсказка по командам консоли
     */
    private function help()
    {
        echo $this->answer['help'];
        return true;
    }
}