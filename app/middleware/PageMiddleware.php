<?php

namespace app\middleware;

use core\route\Middleware;

class PageMiddleware extends Middleware
{




    public function checkAccess()
    {
        if (true) {

            return true;
        }

        return false;
    }


}