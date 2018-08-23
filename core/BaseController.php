<?php

namespace core;

class BaseController
{
    public function __construct()
    {

    }

    /** передаем данные для генерации шаблона
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

    /** подключаем шаблон по имени
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