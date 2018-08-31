<?php

namespace core\config;

use helpers\File;

class Config
{
    const ENV_PATH = '.env';
    const STORAGE_PATH = 'config/storage.php';
    const ERRORS = 'config/errors.php';
    const STATUS = 'config/status.php';

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
    public static function storage($config = null)
    {
        return self::value($config, self::STORAGE_PATH);
    }

    /**
     *  Получаем данные с файла errors
     *
     * @param $config
     * @return mixed
     */
    public static function errors($config = null)
    {
        return self::value($config, self::ERRORS);
    }

    /**
     *  Получаем данные с файла status
     *
     * @param $config
     * @return mixed
     */
    public static function status($config = null)
    {
        return self::value($config, self::STATUS);
    }

    /**
     *  возвращаем значение по ключу
     *
     * @param $config
     * @param $file
     * @return mixed
     */
    private static function value($config, $file)
    {
        $file = include_once $file;
        return $config ? $file[$config] : $file;
    }

    /**
     *  возврат параметра
     *
     * @param $config
     * @param $file
     * @return bool
     */
    private static function config($config, $file)
    {
        return self::getConfig($config,  File::returnFileRows($file));
    }

    /** возвращаем параметр по имени config
     *
     * @param $data
     * @param $config
     * @return bool
     */
    private static function getConfig($config, $rows)
    {
        foreach ($rows as $row){

            $option = explode("=", $row);

            if ($config == trim($option[0])) {

                return $option[1];
            }
        }

        return null;
    }
}