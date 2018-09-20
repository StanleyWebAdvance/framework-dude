<?php

namespace helpers;

class Crypt
{
    /**
     * @param $password
     * @return string
     */
    public static function password($password)
    {
        return crypt($password, StringDude::genRandomString(60));
    }

    /** проверяем пароль
     *
     * @param $password
     * @param $passwordDB
     * @return bool
     */
    public static function checkPassword($password, $passwordDB)
    {
        return ($passwordDB == crypt($password, $passwordDB));
    }
}