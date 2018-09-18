<?php

namespace core\DB;

use helpers\StringDude;

trait Password
{
    /**
     * @param $password
     * @return string
     */
    public function cryptPassword($password)
    {
        return crypt($password, StringDude::genRandomString(60));
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