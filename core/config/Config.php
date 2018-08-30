<?php

namespace core\config;

use core\exception\ErrorHandler;

class Config
{
    const ENV_PATH = '.env';
    const STORAGE_PATH = 'config/storage.php';

    /**
     *  Получаем данные с файла .env
     *
     * @param $config
     * @return bool
     */
    public static function env($config)
    {
        return self::config($config, self::ENV_PATH);
    }

    /**
     *  Получаем данные с файла storage
     *
     * @param $config
     * @return mixed
     */
    public static function storage($config)
    {
        return self::path($config, self::STORAGE_PATH);
    }

    /**
     *  возвращаем значение по ключу
     *
     * @param $config
     * @param $file
     * @return mixed
     */
    private static function path($config, $file)
    {
        $file = include_once $file;
        return $file[$config];
    }

    /**
     *  возврат параметра
     *
     * @param $config
     * @param $file
     * @return bool
     * @throws ErrorHandler
     */
    private static function config($config, $file)
    {
        if (!file_exists($file)) {

            throw new ErrorHandler('Файл ' . $file . ' не найден');
        }

        return self::getConfig($config, self::getData($file));
    }

    /** возвращаем параметр по имени config
     *
     * @param $data
     * @param $config
     * @return bool
     */
    private static function getConfig($config, $data)
    {
        foreach ($data as $str){

            $option = explode("=", $str);

            if ($config == trim($option[0])) {

                return $option[1];
            }
        }
        return null;
    }

    /** выбираем данные с файла построчно
     *  убираем лишние переносы
     *
     * @return array|mixed
     */
    private static function getData($file)
    {
        $fileData = fopen($file, "rb");
        $data = explode("\n", fread($fileData, filesize($file)));
        $data = str_replace(array("\r", "\n"), "", $data);
        fclose($fileData);

        return $data;
    }
}