<?php 
namespace app\controllers;

use app\models\UsersModel;
use app\requests\LoginRequest;
use core\session\Auth;
use core\session\Cookies;
use core\template\Controller;
use helpers\Crypt;

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

        $mUser = new UsersModel();

        $user = $mUser->getByEmail($request->post('email'));

        if ($user) {

            if (!Crypt::checkPassword($request->post('password'), $user['password'])) {

                return $this->index(array('password' => 'Пароль введен не верно'));
            }

            Auth::auth($user, $request->post('remember'));

            $this->redirect('/dashboard');

            return true;
        }

        return $this->index(array('email' => 'Пользователя с таким email нет'));
    }

    public function logout()
    {
        Auth::clear();

        Cookies::clear();

        $this->redirect('/');
    }
}