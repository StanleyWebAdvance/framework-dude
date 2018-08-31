<?php

namespace core\template;

use helpers\Snippet;

class Token
{
    const SALT = 'ry23ur34yur36fdf5sd43';
    const TOKEN_PATH = 'resources/snippet/token.txt';

    /** генерация токена
     *
     * @return string
     */
    public static function generate()
    {
        $key = hash_hmac('sha256', self::SALT, bin2hex(random_bytes(32)));
        self::putSession($key);
        return Snippet::render(self::TOKEN_PATH, array(

            '_token' => $key
        ));
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