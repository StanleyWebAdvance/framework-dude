<?php

namespace core;

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
        if (!$this->request->isGet()){
            return 'метод не гет';
        }

        $this->updateParam($uri, $controller);
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
        if (!$this->request->isPost()){
            return 'метод не пост';
        }

        $this->updateParam($uri, $controller);
        return true;
    }

    /** заполняем массив параметров
     *  для вызова нужного метода
     *
     * @param $uri
     * @param $controller
     */
    private function updateParam($uri, $controller)
    {
        $param = explode("@", $controller);

        $controller = sprintf('app\controllers\%s', $param[0]);

        $this->routeCollection[$uri] = array(
            'action' => $param[1],
            'controllerObject' => new $controller()
        );
    }

    /** Запускаем метод котроллера
     *
     */
    public function run()
    {
        $uri = $_SERVER['REQUEST_URI'];

        if (!isset($this->routeCollection[$uri])) {

            return $this->systemPage('404');
        }

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
}

