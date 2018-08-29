<?php

namespace core\request;

use core\Container;
use core\RegisterInterface;


/**
 *  Можно регистрировать request классы с помощью этого класса
 *  но пока он только усложняет
 *
 * *************************************************************************
 *
 *      пример регистрации и дальнейшего использования из контроллера:
 *
 * *************************************************************************
 *
 *
 *        $this->container->register(new RequestRegister(), 'PageRequest');
 *        $message = $this->container->execute('PageRequest')->checkPost();
 *
 *
 * Class RequestRegister
 * @package core\request
 */


class RequestRegister implements RegisterInterface
{
    /**
     *  Передаем объект для регистрации
     *  Можно добавить выполнение методов они будут скрыты для пользователя
     *
     * @param Container $container
     * @param $name
     */
    public function register(Container $container, $name)
    {
        $container->set($name, function () use ($name){

            $class = '\app\requests\\' . $name;

            $boxRequest = new $class();

            return $boxRequest;

        });
    }
}