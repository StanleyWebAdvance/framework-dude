<?php 
namespace app\middleware;

use core\route\Middleware;

class UserMiddleware extends Middleware
{
    public function checkAccess()
    {
        return true;
    }
}