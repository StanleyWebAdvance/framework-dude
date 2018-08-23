<?php

namespace app\controllers;

use core\Request;

class PageController extends BaseController
{
    public function index()
    {
        return $this->view('admin/index', array(
            'page' => 'index'
        ));
    }

    public function edit($params = array())
    {
        return $this->view('admin/edit', array(
            'page' => 'edit!',
            'id' => 'Ваш id = ' . $params['id']
        ));
    }

    public function store($params = array())
    {
        return $this->view('admin/index', array(
            'page' => 'index (store)',
            'name' => 'Привет ' . $params['name']
        ));
    }
}