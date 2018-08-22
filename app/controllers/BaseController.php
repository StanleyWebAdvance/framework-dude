<?php

namespace app\controllers;

use core\Template;

class BaseController
{
    public function __construct()
    {

    }

    /** �������� ������ ��� ��������� ���������
     *
     * @param $uriView
     * @param array $params
     * @return bool
     */
    protected function view($uriView, array $params = array())
    {
        $template = new Template();
        return $template->Render($uriView, $params);
    }

    /** ���������� ��������� ���������
     *
     * @param $page
     * @return bool
     */
    public function systemPage($page)
    {
        $template = new Template();
        return $template->Render($page);
    }
}