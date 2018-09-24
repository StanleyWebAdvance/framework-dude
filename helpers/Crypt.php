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
}