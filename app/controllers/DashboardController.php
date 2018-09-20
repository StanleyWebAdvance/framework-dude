<?php 
namespace app\controllers;

use app\models\UsersModel;
use core\template\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $mUser = new UsersModel();
        
        return $this->view('admin/dashboard');
    }
}