<?php 
namespace app\controllers;

use app\requests\LoginRequest;
use core\template\Controller;
use helpers\Debug;

class LoginController extends Controller
{
    public function index($errors = array())
    {
        return $this->view('admin/login', array(

            'title' => 'Вход',
            'errors' => $errors
        ));
    }

    public function login()
    {
        $request = new LoginRequest();
        $message = $request->checkPost();

        if ($message['error']) {

            return $this->index($message['errors']);
        }

        Debug::dump('проверить в базе');
    }
}