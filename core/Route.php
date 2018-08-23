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

    /** ����������� ��� ��������� �� ������ ������� GET
     *
     * @param $uri
     * @param $controller
     * @return bool|string
     */
    public function get($uri, $controller)
    {
//        if (!$this->request->isGet()){
//            return '����� �� ���';
//        }

        $this->getControllerMethod($uri, $controller);
        return true;
    }

    /** ����������� ��� ��������� �� ������ ������� POST
     *
     * @param $uri
     * @param $controller
     * @return bool|string
     */
    public function post($uri, $controller)
    {
//        if (!$this->request->isPost()){
//            return '����� �� ����';
//        }

        $this->getControllerMethod($uri, $controller);
        return true;
    }

    /** ��������� ������ �������
     *  ��� ������ ������� ������ �����������
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

    /** ��������� ����� ����������
     *
     */
    public function run()
    {
        $uri = $this->request->server('REQUEST_URI');

        if (!isset($this->routeCollection[$uri])) {

            return $this->systemPage('404');
        }

//        todo ������ �������� �� ����� ��� ������ ���� �����

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

                //��������� �������� ��� ������� � : � �� / ��� �������  -->  [^:]\w+[^ /]
                $nameParam = preg_replace('~[:]~', '', $uriArray[$i]);

                $param[$nameParam] = $uriUser[$i];
            }
        }

        return $param;
    }
}

