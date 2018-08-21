<?php

namespace config;

abstract class BaseConfig
{
    protected $data;

    public function __construct()
    {
        if (!file_exists(".env")) {
            return "���� ���-�� ������� � ���� ������";
        }

        $this->data = $this->getData();
        return true;
    }

    /** ������ ���� .env
     *
     * @return array|mixed
     */
    private function getData()
    {
        $fileData = fopen(".env", "rb");
        $data = explode("\n", fread($fileData, filesize(".env")));
        $data = str_replace(array("\r", "\n"), "", $data);
        fclose($fileData);

        return $data;
    }

    /** ���������� �������� �� ����������� ����� config
     *  �� ����� .env
     *
     * @param $data
     * @param $config
     * @return bool
     */
    protected function parseConfig($data, $config)
    {
        foreach ($data as $str){

            $option = explode("=", $str);

            if ($config == trim($option[0])) {

                return $option[1];
            }
        }
        return false;
    }

}