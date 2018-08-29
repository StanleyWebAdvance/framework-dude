<?php

namespace core;

use core\exception\ErrorHandler;

class Container
{
    private $container = [];

    /**
     *  Записываем в контейнер объекты классов по имени
     *
     * @param $name
     * @param \Closure $callback
     * @param array $params
     */
    public function set($name, \Closure $callback)
    {
        $this->container[$name] = $callback();
    }

    /**
     *  Принимаем класс регистрации кот имплементится от интерфайса RegisterInterface
     *  Принимаеи имя класса который надо зарегестрировать
     *
     * @param RegisterInterface $box
     * @param $name
     */
    public function register(RegisterInterface $box, $name)
    {
        $box->register($this, $name);
    }

    /**
     *  Выполняем зарегестрированный класс по имени
     *
     * @param $name
     * @param array $params
     * @return mixed
     * @throws ErrorHandler
     */
    public function execute($name, array $params = array())
    {
        if (!$this->container[$name]) {

            throw new ErrorHandler('В контейнере не найден объект');
        }

        return $this->container[$name];
    }
}