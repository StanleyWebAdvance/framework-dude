<?php

namespace helpers;

use core\exception\ErrorHandler;

class Snippet
{
    /** получаем нужный шаблон
     *  и заполняем его данными
     *
     * @param $filePath
     * @param array $params
     * @return string
     */
    public static function render($file, array $params = array())
    {
        if (!file_exists($file)) {

            throw new ErrorHandler('Файл ' . $file . ' не найден');
        }

        ob_start();
        extract($params);
        include_once $file;

        return ob_get_clean();
    }
}
