<?php

namespace core\session;

class Auth
{
    private static $authSession;

    /**
     *  Получаем данные с сессии
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
     *  Устанавливаем куки
     *
     * @param $user
     * @param bool $setCookie
     */
    public static function auth($user, $setCookie = false)
    {
        self::construct();

        self::$authSession['auth'] = array(

            'userId' => $user['id'],
            'name'   => $user['name'],
            'email'  => $user['email'],
        );

        if ($setCookie) {

            Cookies::set($user);
        }
    }

    /**
     *  возвращаем пользователя с сессии
     *
     * @return mixed
     */
    public static function user()
    {
        self::construct();

        return self::$authSession['auth'];
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
    public static function clear()
    {
        self::construct();

        self::$authSession = false;
    }
}