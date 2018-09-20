<?php 
namespace app\controllers;

use core\session\Auth;
use core\template\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return $this->view('admin/dashboard', array(

            'user' => Auth::user()
        ));
    }
}