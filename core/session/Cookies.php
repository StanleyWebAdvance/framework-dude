<?php

namespace core\session;

use app\models\UsersModel;

class Cookies
{
    /**
     *  Устанавливаем куки
     *
     * @param $user
     */
    public static function set($user)
    {
        setcookie('dude', $user['id'], time() + (60 * 60 * 24 * 7));
    }

    /**
     *  Если куки есть и пользователь найден
     *  Создаем сессию
     *
     * @param $cookie
     * @return bool
     */
    public static function check($cookie)
    {
        if (!isset($cookie['dude'])) { return true; }

        $user = (new UsersModel())->getById($cookie['dude']);

        if (isset($user)) {

            Auth::auth($user);
        }

        return true;
    }

    /**
     *  Очищаем сессию
     */
    public static function clear()
    {
        setcookie('dude', '', time() - 1);
    }
}