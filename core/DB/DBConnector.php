<?php

namespace core\DB;

use core\Config;

class DBConnector
{
    protected static $instance;
    protected function __construct() {}

    public static function getInstance()
    {

        $configDB = new Config('.env');

        if(empty(self::$instance)) {

            $db_info = array(

                "db_host" => $configDB->parseConfig('DB_HOST'),
                "db_port" => $configDB->parseConfig('DB_PORT'),
                "db_user" => $configDB->parseConfig('DB_USERNAME'),
                "db_pass" => $configDB->parseConfig('DB_PASSWORD'),
                "db_name" => $configDB->parseConfig('DB_DATABASE'),
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