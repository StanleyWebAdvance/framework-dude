<?php

namespace core\route;

use core\request\Request;
use core\exception\ErrorHandler;

class Route
{
    private $routeCollection = array();
    protected $request;
    protected $middleware;

    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->middleware = new Middleware($request);
    }

    /** вызов роута из web.php
     *
     * @param $name
     * @param $arguments
     */
    public function __call($name, $arguments)
    {
        $arguments[2] = isset($arguments[2]) ? $arguments[2] : null;
        $this->getControllerMethod($arguments[0], $arguments[1], $arguments[2], $name);
    }

    /** заполняем массив контроллеров
     *  для вызова метода соответствующего адресу вызова
     *
     * @param $uri
     * @param $controller
     */
    private function getControllerMethod($uri, $controller, $middleware, $method)
    {
        $param = explode("@", $controller);

        $controller = sprintf('app\controllers\%s', $param[0]);

        $this->routeCollection[$this->parseUri($uri)][mb_strtolower($method)] = array(

            'action' => $param[1],
            'middleware' => $middleware,
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

        //  проверям есть ли такой роут в нашей коллекции
        if (!isset($this->routeCollection[$uri])) {

            return $this->systemPage('404');
        }

        //  получаем реальный метод обращения на страницу
        $realMethod = mb_strtolower($this->request->getMethod());

        //  проверяем соответствует ли метод заявленому
        if (!isset($this->routeCollection[$uri][$realMethod])) {

            throw new ErrorHandler('Пришли на страницу не тем методом');
        }

        //  запускаем мидлеваре
        if (!empty($this->routeCollection[$uri][$realMethod]['middleware'])) {

            if (!$this->middleware($this->routeCollection[$uri][$realMethod]['middleware'])) {

                //  если мидлеваре вернул фалсе то доступа по роуту нет, 404
                return $this->systemPage('404');
            }
        }

        //  получем нужный контроллер и метод
        $controllerObject = $this->routeCollection[$uri][$realMethod]['controllerObject'];
        $action = $this->routeCollection[$uri][$realMethod]['action'];

        //  если в массиве есть параметры запускаем метод контроллера с параметрами
        if (!empty($this->routeCollection[$uri][$realMethod]['param'])) {

            $controllerObject->$action($this->routeCollection[$uri][$realMethod]['param']);
            return true;
        }

        //  запускаем метод контроллера
        $controllerObject->$action();
        return true;
    }

    /** подключаем соответствующий мидлеваре
     *
     * @param $nameMiddleware
     * @return bool
     */
    private function middleware($nameMiddleware)
    {
        $nameMiddleware = $nameMiddleware . 'Middleware';

        if (!file_exists('app\middleware\\' . $nameMiddleware . '.php')) {

            throw new ErrorHandler('Файл ' . $nameMiddleware . ' не найден.');
        }

        $middleware = 'app\middleware\\' . $nameMiddleware;
        $middleware = new $middleware($this->request);
        return $middleware->checkAccess();
    }

    /**
     * @param $page
     * @return bool
     */
    private function systemPage($page)
    {
        if (!file_exists('core\template\Controller.php')) {

            throw new ErrorHandler('Файл Controller.php не найден.');
        }

        $controller = 'core\template\Controller';
        $controller = new $controller;
        return $controller->systemPage($page);
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

