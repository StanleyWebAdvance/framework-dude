<?php

namespace core;

use helpers\Debug;

class Config
{
    private $data;
    private $fileName;

    public function __construct($fileName)
    {
        if (!file_exists($fileName)) {

            //  todo обработать ошибку
            Debug::dump("файл не найден решить что-то с ошибками");
            return false;
        }

        $this->fileName = $fileName;
        $this->data = $this->getData($fileName);
        return true;
    }

    /** выбираем данные с файла построчно
     *  убираем лишние переносы
     *
     * @return array|mixed
     */
    private function getData($fileName)
    {
        $fileData = fopen($fileName, "rb");
        $data = explode("\n", fread($fileData, filesize(".env")));
        $data = str_replace(array("\r", "\n"), "", $data);
        fclose($fileData);

        return $data;
    }

    /** возвращаем параметр по имени config
     *
     * @param $data
     * @param $config
     * @return bool
     */
    public function parseConfig($config)
    {
        foreach ($this->data as $str){

            $option = explode("=", $str);

            if ($config == trim($option[0])) {

                return $option[1];
            }
        }
        return false;
    }
}