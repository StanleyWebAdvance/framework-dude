<?php 
namespace app\controllers;

use app\requests\RegistrationRequest;
use core\template\Controller;
use helpers\Debug;

class RegistrationController extends Controller
{
    public function index($errors = array())
    {
        return $this->view('admin/registration', array(

            'title' => 'Регистрация',
            'errors' => $errors
        ));
    }

    public function registration()
    {
        $request = new RegistrationRequest();
        $message = $request->checkPost();

        if ($message['error']) {

            return $this->index($message['errors']);
        }

        Debug::dump('записать в базу');
    }
}