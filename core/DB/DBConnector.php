<?php

namespace core\DB;

use core\config\Config;

class DBConnector
{
    protected static $instance;
    protected function __construct() {}

    public static function getInstance()
    {
        if(empty(self::$instance)) {

            $db_info = array(

                "db_host" => Config::env('DB_HOST'),
                "db_port" => Config::env('DB_PORT'),
                "db_user" => Config::env('DB_USERNAME'),
                "db_pass" => Config::env('DB_PASSWORD'),
                "db_name" => Config::env('DB_DATABASE'),
                "db_charset" => "UTF-8"
            );

            self::$instance = new \PDO("mysql:host=".$db_info['db_host'].';port='.$db_info['db_port'].';dbname='.$db_info['db_name'], $db_info['db_user'], $db_info['db_pass']);
            self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_SILENT);
            self::$instance->query('SET NAMES utf8');
            self::$instance->query('SET CHARACTER SET utf8');
        }
        return self::$instance;
    }

    public static function setCharsetEncoding()
    {
        if (self::$instance == null) {
            self::connect();
        }
        self::$instance->exec(
            "SET NAMES 'utf8';
			SET character_set_connection=utf8;
			SET character_set_client=utf8;
			SET character_set_results=utf8");
    }
}