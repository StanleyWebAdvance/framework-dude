<?php

namespace core\session;

use core\request\Request;
use helpers\Debug;

class Auth
{
    public static $authSession;

    private static function construct()
    {
        if (!isset($_SESSION['auth'])) {

            $_SESSION['auth'] = array();
        }
        self::$authSession = &$_SESSION['auth'];
    }

    public static function authSession($user)
    {
        self::construct();

        self::$authSession['auth'] = array(

            'userId' => $user['id'],
            'name'   => $user['name'],
            'email'  => $user['email'],
        );
    }

    public static function isAuth()
    {
        if (isset(self::$authSession['auth']['userId'])) {

            return true;
        }

        return false;
    }

    public static function clearAuthSession()
    {
        self::$authSession = false;
    }
}