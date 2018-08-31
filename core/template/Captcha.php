<?php

namespace core\template;

use core\config\Config;
use helpers\Snippet;

class Captcha
{
    const CAPTCHA_PATH = 'resources/snippet/captcha.txt';

    public static function get()
    {
        return Snippet::render(self::CAPTCHA_PATH, array(

            'siteKey' => Config::env('CAPTCHA_DATA_SITEKEY'),
        ));
    }
}