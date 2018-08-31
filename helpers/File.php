<?php

namespace helpers;

use core\exception\ErrorHandler;

class File
{
    /** выбираем данные с файла построчно
     *  убираем лишние переносы
     *
     * @return array|mixed
     */
    public static function returnFileRows($file)
    {
        if (!file_exists($file)) {

            throw new ErrorHandler('Файл ' . $file . ' не найден');
        }

        $fileData = fopen($file, "rb");
        $data = explode("\n", fread($fileData, filesize($file)));
        $data = str_replace(array("\r", "\n"), "", $data);
        fclose($fileData);

        return $data;
    }
}