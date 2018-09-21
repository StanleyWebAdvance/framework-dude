<?php

namespace core\request;

use helpers\Debug;

class Request
{
    const METHOD_POST   = 'POST';
    const METHOD_GET    = 'GET';

    public  $rulesPost  = array();
    public  $rulesFile  = array();

    private $get;
    private $post;
    private $server;
    private $cookie;
    private $files;
    private $session;

    private $errors     = array();
    private $key;

    public function __construct()
    {
        $this->get     = $_GET;
        $this->post    = $_POST;
        $this->server  = $_SERVER;
        $this->cookie  = $_COOKIE;
        $this->files   = $_FILES;
        $this->session = $_SESSION;
    }

    /**
     *  Записывам массив с ошибками
     *
     * @param $errors
     */
    protected function setErrors($errors)
    {
        $this->errors = $errors;
    }

    /**
     *  Возвращаем массив с ошибками
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /** возвращаем значение с массива пост по ключу
     *  либо весь массив
     *
     * @param null $name
     * @return array|mixed|null
     */
    public function post($name = null)
    {
        return $this->getArr($this->post, $name);
    }

    /** возвращаем значение с массива гет по ключу
     *  либо весь массив
     *
     * @param null $name
     * @return array|mixed|null
     */
    public function get($name = null)
    {
        return $this->getArr($this->get, $name);
    }

    /** возвращаем значение с массива FILES по имени либо полностью
     *  либо весь массив
     *
     * @param null $name
     * @return array|mixed|null
     */
    public function files($name = null)
    {
        return $this->key ? $this->filesKey($name, $this->key) : $this->getArr($this->files, $name);
    }

    /**
     *  Возвращаем значение массима FILES по ключу
     *
     * @param $name
     * @param $key
     * @return mixed
     */
    private function filesKey($name, $key)
    {
        $this->key = null;
        return $this->getArr($this->files, $name)[$key];
    }

    /**
     *  Запоминаем ключ массива, чтоб вернуть по нему значение
     *
     * @param null $name
     * @return $this
     */
    public function take($name = null)
    {
        $this->key = $name;
        return $this;
    }

    /** возвращаем значение с массива сесии по ключу
     *  либо весь массив
     *
     * @param null $name
     * @return array|mixed|null
     */
    public function session($name = null)
    {
        return $this->getArr($this->session, $name);
    }

    /** возвращаем значение с массива cookie по ключу
     *  либо весь массив
     *
     * @param null $name
     * @return array|mixed|null
     */
    public function cookie($name = null)
    {
        return $this->getArr($this->cookie, $name);
    }

    /** возвращаем значение с массива сервер по ключу
     *  либо весь массив
     *
     * @param null $name
     * @return array|mixed|null
     */
    public function server($name = null)
    {
        return $this->getArr($this->server, $name);
    }

    /** получаем текущий метод
     *
     * @return mixed
     */
    public function getMethod()
    {
        return $this->server['REQUEST_METHOD'];
    }

    /** проверяем какой был запрос GET
     *
     * @return bool
     */
    public function isGet()
    {
        return $this->server['REQUEST_METHOD'] === self::METHOD_GET;
    }

    /** проверяем какой был запрос POST
     *
     * @return bool
     */
    public function isPost()
    {
        return $this->server['REQUEST_METHOD'] === self::METHOD_POST;
    }

    /** возвращаем значение по ключу
     *
     * @param array $arr
     * @param null $name
     * @return array|mixed|null
     */
    private function getArr(array $arr, $name = null)
    {
        if (!$name) return $arr;
        return (isset($arr[$name])) ? $arr[$name] : null;
    }
}