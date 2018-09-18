<?php 
namespace app\middleware;

use core\route\Middleware;
use core\session\Auth;
use Symfony\Component\Debug\Debug;

/*********************************************************************
 *
 *      Проверяем какое-нибудь условие, если вернет:
 *      false - то выкинет на 404 страницу,
 *      true  - доступ к странице есть
 *
 *********************************************************************/

class DashboardMiddleware extends Middleware
{
    public function checkAccess()
    {
        return Auth::isAuth();
    }
}