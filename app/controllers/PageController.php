<?php

namespace app\controllers;

use core\template\Controller;

class PageController extends Controller
{
    public function index()
    {
        return $this->view('front/index', array(

            'title' => 'Главная',
        ));
    }

    public function login($errors = array())
    {
        return $this->view('admin/login', array(

            'title' => 'Главная',
            'errors' => $errors
        ));
    }

    public function registration($errors = array())
    {
        return $this->view('admin/registration', array(

            'title' => 'Главная',
            'errors' => $errors
        ));
    }

}