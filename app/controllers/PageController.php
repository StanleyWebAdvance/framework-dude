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

    public function edit()
    {
        return $this->view('admin/edit', array(
            'page' => 'hello!'
        ));
    }

    public function store(Request $request, $id)
    {
        return $this->view('admin/index', array(
            'page' => 'записано',
            'message' => $id
        ));
    }
}