<?php

namespace app\controllers;

use core\Request;
use core\BaseController;

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

            //  todo    почемуто с адресной строке не пишется admin
            return $this->view('admin/admin');
        }

        return $this->login('ты не Вася ! ! !');
    }

}