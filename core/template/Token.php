<?php

namespace core\template;

class Token
{
    const SALT = 'ry23ur34yur36fdf5sd43';

    /** генерация токена
     *
     * @return string
     */
    public static function generate()
    {
        $key = hash_hmac('sha256', self::SALT, bin2hex(random_bytes(32)));
        self::putSession($key);
        return $key;
    }

    /** записываем токен в сессию
     *
     * @param $key
     */
    private static function putSession($key)
    {
        $_SESSION['_token'] = $key;
    }
}