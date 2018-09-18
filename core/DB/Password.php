<?php

namespace core\DB;

use helpers\String;

trait Password
{
    /**
     * @param $password
     * @return string
     */
    public function cryptPassword($password)
    {
        return crypt($password, String::genRandomString(60));
    }

    /** проверяем пароль
     *
     * @param $password
     * @param $passwordDB
     * @return bool
     */
    public function checkPassword($password, $passwordDB)
    {
        return ($passwordDB == crypt($password, $passwordDB));
    }
}