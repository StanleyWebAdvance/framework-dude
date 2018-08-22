<?php

namespace app\controllers;

class PageController extends BaseController
{
    public function index()
    {
        return $this->view('admin/index', array(
            'page' => 'index'
        ));
    }

    public function edit()
    {
        return $this->view('admin/edit', array(
            'page' => 'hello!'
        ));
    }
}