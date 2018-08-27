<?php namespace app\controllers;

use app\requests\PageRequest;
use core\DB\DBConnector;
use core\exception\ErrorHandler;
use core\template\Controller;
use app\models\PageModel;

class PageController extends Controller
{
    public function index()
    {
        $pages = new PageModel(DBConnector::getInstance());

        return $this->view('admin/index', array(

            'title' => 'Главная',
            'pages' => $pages->getAll()
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

        try {

            $message = $request->checkPost();
        } catch (ErrorHandler $e) {

            $e->logError();
            exit();
        }

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