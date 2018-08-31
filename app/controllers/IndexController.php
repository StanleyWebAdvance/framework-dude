<?php

namespace app\controllers;

use core\template\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return $this->view('front/index', array(

            'title' => 'Главная',
        ));
    }
}