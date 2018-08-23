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

    /** метод GET
     *
     * @param $uri
     * @param $controller
     * @return bool|string
     */
    public function get($uri, $controller)
    {
//        if (!$this->request->isGet()){
//            return 'это не гет';
//        }

        $this->getControllerMethod($uri, $controller, 'GET');
        return true;
    }

    /** метод POST
     *
     * @param $uri
     * @param $controller
     * @return bool|string
     */
    public function post($uri, $controller)
    {
//        if (!$this->request->isPost()){
//            return 'не пост';
//        }

        $this->getControllerMethod($uri, $controller, 'POST');
        return true;
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

//        $this->parseUri($uri);

        $this->routeCollection[$this->parseUri($uri)] = array(
            'action' => $param[1],
            'controllerObject' => new $controller(),
            'param' => $this->parseParam($uri),
            'method' => $method
        );

    }

    /** запускаем метод контроллера
     *
     */
    public function run()
    {
        $uri = $this->request->server('REQUEST_URI');

        Debug::dump($this->routeCollection[$uri]['param']);

        if (!isset($this->routeCollection[$uri])) {

            return $this->systemPage('404');
        }

//        todo проверку на гет и пост видимо здесь

        $controllerObject = $this->routeCollection[$uri]['controllerObject'];
        $action = $this->routeCollection[$uri]['action'];

        if (!empty($this->routeCollection[$uri]['param'])) {

            $controllerObject->$action($this->routeCollection[$uri]['param']);
            return true;
        }

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

