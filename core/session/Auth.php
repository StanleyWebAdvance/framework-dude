<?php

namespace core\session;

class Auth
{
    private static $authSession;

    /**
     *  Активируем сессию
     */
    private static function construct()
    {
        if (!isset($_SESSION['auth'])) {

            $_SESSION['auth'] = array();
        }
        self::$authSession = &$_SESSION['auth'];
    }

    /**
     *  Заполняем сессию
     *
     * @param $user
     */
    public static function authSession($user)
    {
        self::construct();

        self::$authSession['auth'] = array(

            'userId' => $user['id'],
            'name'   => $user['name'],
            'email'  => $user['email'],
        );
    }

    /**
     *  Проверяем есть ли юзер в сесии
     *
     * @return bool
     */
    public static function isAuth()
    {
        self::construct();

        if (isset(self::$authSession['auth']['userId'])) {

            return true;
        }

        return false;
    }

    /**
     *  Очищаем сессию
     */
    public static function clearAuthSession()
    {
        self::construct();

        self::$authSession = false;
    }
}