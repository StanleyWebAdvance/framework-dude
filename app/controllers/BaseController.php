<?php

namespace app\controllers;

use core\Template;

abstract class BaseController
{
    public function __construct()
    {

    }

    protected function view($uriView, array $params = array())
    {
        $template = new Template();
        return $template->Render($uriView, $params);
    }
}