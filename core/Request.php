<?php

namespace core;

class Request
{
    const METHOD_POST = 'POST';
    const METHOD_GET = 'GET';
    const METHOD_DELETE = 'DELETE';
    const METHOD_PUT = 'PUT';
    const METHOD_UPDATE = 'UPDATE';

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

    /** �������� ������ � ������� ����
     *
     * @param null $name
     * @return array|mixed|null
     */
    public function post($name = null)
    {
        return $this->getArr($this->post, $name);
    }

    /** �������� ������ � ������� ������
     *
     * @param null $name
     * @return array|mixed|null
     */
    public function server($name = null)
    {
        return $this->getArr($this->server, $name);
    }

    /** �������� ������ ��������� �� �������� GET
     *
     * @return bool
     */
    public function isGet()
    {
        return $this->server['REQUEST_METHOD'] === self::METHOD_GET;
    }

    /** �������� ������ ��������� �� �������� POST
     *
     * @return bool
     */
    public function isPost()
    {
        return $this->server['REQUEST_METHOD'] === self::METHOD_POST;
    }

    /** ���������� ������ � ������� �� �����
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