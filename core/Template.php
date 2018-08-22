<?php

namespace core;

class Template
{
    public function Render($uri, array $params = array())
    {
        ob_start();
        extract($params);
        include_once "/resources/view/" . $uri . ".php";
        echo ob_get_clean();

        return true;
    }
}