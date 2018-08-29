<?php

namespace core\route;

use core\request\Request;


class Middleware
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     *  проверка доступа
     */
    protected function checkAccess()
    {
        return true;
    }
}