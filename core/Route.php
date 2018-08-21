<?php

namespace core;

class Route
{
    private $routeCollection = array();

    public function addRoute($uri, \Closure $closure)
    {
        $this->routeCollection[$uri] = $closure;
    }

    public function run()
    {
        $uri = $_SERVER['REQUEST_URI'];

        if (!isset($this->routeCollection[$uri])) {

            die('404');
        }

        $this->routeCollection[$uri]();
    }
}

