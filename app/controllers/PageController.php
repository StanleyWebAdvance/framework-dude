<?php

namespace app\controllers;

use core\Request;
use helpers\Debug;

class PageController extends BaseController
{
    public function index()
    {
        return $this->view('admin/index');
    }

    public function login($error = '')
    {
        return $this->view('admin/login', array(
            'error' => $error
        ));
    }

    public function admin(Request $request)
    {
        if ($request->post('name') === 'Вася') {

            return $this->view('admin/admin');
        }

        return $this->login('ты не Вася ! ! !');
    }

}