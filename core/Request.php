<?php

namespace core;

class Request
{
    const METHOD_POST = 'POST';
    const METHOD_GET = 'GET';

    private $get;
    private $post;
    private $server;
    private $cookie;
    private $files;
    private $session;

    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->server = $_SERVER;
        $this->cookie = $_COOKIE;
        $this->files = $_FILES;
        $this->session = $_SESSION;
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