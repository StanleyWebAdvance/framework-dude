<?php

namespace core;

use helpers\Debug;

class Route
{
    private $routeCollection = array();
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /** вызов роута из web.php
     *
     * @param $name
     * @param $arguments
     */
    public function __call($name, $arguments)
    {
        $this->getControllerMethod($arguments[0], $arguments[1], $name);

    }

    /** заполняем массив контроллеров
     *  для вызова метода соответствующего адресу вызова
     *
     * @param $uri
     * @param $controller
     */
    private function getControllerMethod($uri, $controller, $method)
    {
        $param = explode("@", $controller);

        $controller = sprintf('app\controllers\%s', $param[0]);

        $this->routeCollection[$this->parseUri($uri)][mb_strtolower($method)] = array(
            'action' => $param[1],
            'controllerObject' => new $controller(),
            'param' => $this->parseParam($uri),
        );
    }

    /** Проверяем есть ли такой роут
     *  проверяем правильный ли метод
     *  запускам соответствующий контроллер->метод
     *
     * @return bool
     */
    public function run()
    {
        $uri = $this->request->server('REQUEST_URI');

        if (!isset($this->routeCollection[$uri])) {

            return $this->systemPage('404');
        }

        $realMethod = mb_strtolower($this->request->getMethod());

        if (!isset($this->routeCollection[$uri][$realMethod])) {

            //  todo обработать ошибку
            Debug::dump('такого метода не сущствует');
            return false;
        }

        $controllerObject = $this->routeCollection[$uri][$realMethod]['controllerObject'];
        $action = $this->routeCollection[$uri][$realMethod]['action'];

        if (!empty($this->routeCollection[$uri][$realMethod]['param'])) {

            $controllerObject->$action($this->request, $this->routeCollection[$uri][$realMethod]['param']);
            return true;
        }

//        if ($this->request->isPost()) {
//
//            $controllerObject->$action($this->request);
//            return true;
//        }

        $controllerObject->$action();
        return true;
    }

    /**
     * @param $page
     * @return bool
     */
    private function systemPage($page)
    {
        $controller = 'app\controllers\BaseController';
        $controller = new $controller;
        $controller->systemPage($page);
        return true;
    }

    //  todo объеденить эти 2 метода
    private function parseParam($uri)
    {
        $param = array();
        $uriArray = explode('/', $uri);
        $uriUser = explode('/', $this->request->server('REQUEST_URI'));

        for ($i=0; $i<count($uriArray); $i++) {

            if (preg_match('~[:]~', $uriArray[$i])) {

                //регулярка выбирает все от : до / или пробела  -->  [^:]\w+[^ /]
                $nameParam = preg_replace('~[:]~', '', $uriArray[$i]);

                $param[$nameParam] = $uriUser[$i];
            }
        }

        return $param;
    }

    //  todo объеденить эти 2 метода
    private function parseUri($uri)
    {

        $uriArray = explode('/', $uri);
        $uriUser = explode('/', $this->request->server('REQUEST_URI'));

        for ($i=0; $i<count($uriArray); $i++) {

            if (preg_match('~[:]~', $uriArray[$i])) {

                $uriArray[$i] = $uriUser[$i];
            }
        }

        return implode('/', $uriArray);
    }

}

