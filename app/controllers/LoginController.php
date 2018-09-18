<?php 
namespace app\controllers;

use app\models\UsersModel;
use app\requests\LoginRequest;
use core\session\Auth;
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

        $user = new UsersModel();

        $haveUser = $user->getByEmail($request->post('email'));

        if ($haveUser) {

            if (!$user->checkPassword($request->post('password'), $haveUser['password'])) {

                return $this->index(array('password' => 'Пароль введен не верно'));
            }

            Auth::authSession($haveUser);

            $this->redirect('/dashboard');

            return true;
        }

        return $this->index(array('email' => 'Пользователя с таким email нет'));
    }

    public function logout()
    {
        Auth::clearAuthSession();

        $this->redirect('/');
    }
}