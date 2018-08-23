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

    /** выполняется при обращении по адресу методом GET
     *
     * @param $uri
     * @param $controller
     * @return bool|string
     */
    public function get($uri, $controller)
    {
//        if (!$this->request->isGet()){
//            return 'метод не гет';
//        }

        $this->getControllerMethod($uri, $controller);
        return true;
    }

    /** выполняется при обращении по адресу методом POST
     *
     * @param $uri
     * @param $controller
     * @return bool|string
     */
    public function post($uri, $controller)
    {
//        if (!$this->request->isPost()){
//            return 'метод не пост';
//        }

        $this->getControllerMethod($uri, $controller);
        return true;
    }

    /** заполняем массив адресов
     *  для вызова нужного метода контроллера
     *
     * @param $uri
     * @param $controller
     */
    private function getControllerMethod($uri, $controller)
    {
        $param = explode("@", $controller);

        $controller = sprintf('app\controllers\%s', $param[0]);

        $this->routeCollection[$uri] = array(
            'action' => $param[1],
            'controllerObject' => new $controller(),
            'param' => $this->parseParam($uri)
        );


    }

    /** Запускаем метод котроллера
     *
     */
    public function run()
    {
        $uri = $this->request->server('REQUEST_URI');

        if (!isset($this->routeCollection[$uri])) {

            return $this->systemPage('404');
        }

//        todo походу проверку на метод тут делать надо будет

        $controllerObject = $this->routeCollection[$uri]['controllerObject'];
        $action = $this->routeCollection[$uri]['action'];
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

                //регулярка выбирает все начиная с : и до / или пробела  -->  [^:]\w+[^ /]
                $nameParam = preg_replace('~[:]~', '', $uriArray[$i]);

                $param[$nameParam] = $uriUser[$i];
            }
        }

        return $param;
    }
}

