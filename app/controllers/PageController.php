<?php

namespace app\controllers;

use app\requests\PageRequest;
use core\template\Controller;

class PageController extends Controller
{
    public function index()
    {
        return $this->view('admin/index', array(

            'title' => 'Главная'
        ));
    }

    public function login($errors = array())
    {
        return $this->view('admin/login', array(

            'title' => 'Вход',
            'errors' => $errors
        ));
    }

    public function enter()
    {
        $request = new PageRequest();
        $request->rules();
        $message = $request->checkPost();

        if ($message['error']) {

            return $this->login($message['errors']);
        }

        $this->redirect('/admin');
        return true;
    }

    public function admin()
    {
        return $this->view('admin/admin', array(

            'title' => 'Вход'
        ));
    }




}