<?php

namespace core\session;

use app\models\UsersModel;

class Cookies
{
    public static function setCookies($user)
    {
        setcookie('dude', $user['id'], time() + 300);
    }

    public static function checkCookies($cookie)
    {
        if (!isset($cookie['dude'])) { return true; }

        $user = (new UsersModel())->getById($cookie['dude']);

        if (isset($user)) {

            Auth::authSession($user);
        }

        return true;
    }
}