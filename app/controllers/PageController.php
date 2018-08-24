<?php

namespace app\controllers;

use app\requests\PageRequest;
use core\BaseController;
use helpers\Debug;

class PageController extends BaseController
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



    public function admin()
    {
        $request = new PageRequest();
        $request->rules();
        $message = $request->checkPost();

        if ($message['error']) {

            return $this->login($message['errors']);
        }



        //  todo    почемуто с адресной строке не пишется admin
        return $this->view('admin/admin', array(

            'title' => 'Вход'
        ));
    }





}