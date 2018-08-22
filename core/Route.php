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

    /** ����������� ��� ��������� �� ������ ������� GET
     *
     * @param $uri
     * @param $controller
     * @return bool|string
     */
    public function get($uri, $controller)
    {
        if (!$this->request->isGet()){
            return '����� �� ���';
        }

        $this->updateParam($uri, $controller);
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
        if (!$this->request->isPost()){
            return '����� �� ����';
        }

        $this->updateParam($uri, $controller);
        return true;
    }

    /** ��������� ������ ����������
     *  ��� ������ ������� ������
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

    /** ��������� ����� ����������
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

