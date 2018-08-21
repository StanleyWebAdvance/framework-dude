<?php

namespace config;

class database extends BaseConfig
{
    private static $DB_CONNECTION;
    private static $DB_HOST;
    private static $DB_PORT;
    private static $DB_DATABASE;
    private static $DB_USERNAME;
    private static $DB_PASSWORD;

    public function __construct()
    {
        parent::__construct();

        self::$DB_CONNECTION = $this->parseConfig($this->data, 'DB_CONNECTION');
        self::$DB_HOST = $this->parseConfig($this->data, 'DB_HOST');
        self::$DB_PORT = $this->parseConfig($this->data, 'DB_PORT');
        self::$DB_DATABASE = $this->parseConfig($this->data, 'DB_DATABASE');
        self::$DB_USERNAME = $this->parseConfig($this->data, 'DB_USERNAME');
        self::$DB_PASSWORD = $this->parseConfig($this->data, 'DB_PASSWORD');
    }

    public static function getDB_CONNECTION()
    {
        return self::$DB_CONNECTION;
    }

    public static function getDB_DATABASE()
    {
        return self::$DB_DATABASE;
    }

    public static function getDB_HOST()
    {
        return self::$DB_HOST;
    }

    public static function getDB_PORT()
    {
        return self::$DB_PORT;
    }

    public static function getDB_USERNAME()
    {
        return self::$DB_USERNAME;
    }

    public static function getDB_PASSWORD()
    {
        return self::$DB_PASSWORD;
    }
}