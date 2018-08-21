<?php

namespace core;

use config\database;

class DBConnector
{
    protected static $instance;
    protected function __construct() {}

    public static function getInstance()
    {
        if(empty(self::$instance)) {
            $db_info = array(
                "db_host" => database::getDB_HOST(),
                "db_port" => database::getDB_PORT(),
                "db_user" => database::getDB_USERNAME(),
                "db_pass" => database::getDB_PASSWORD(),
                "db_name" => database::getDB_DATABASE(),
                "db_charset" => "UTF-8");
            try {
                self::$instance = new \PDO("mysql:host=".$db_info['db_host'].';port='.$db_info['db_port'].';dbname='.$db_info['db_name'], $db_info['db_user'], $db_info['db_pass']);
                self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_SILENT);
                self::$instance->query('SET NAMES utf8');
                self::$instance->query('SET CHARACTER SET utf8');
            } catch(\PDOException $error) {
                echo $error->getMessage();
            }
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