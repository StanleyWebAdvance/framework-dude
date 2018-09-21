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
    public function index()
    {
        return $this->view('admin/login', array(

            'title' => 'Вход'
        ));
    }

    public function login()
    {
        $this->request = new LoginRequest();

        if (!empty($this->request->getErrors())) {

            return $this->index();
        }

        $mUser = new UsersModel();

        $user = $mUser->getByEmail($this->request->post('email'));

        if ($user) {

            if (!Crypt::checkPassword($this->request->post('password'), $user['password'])) {

                return $this->index();  // array('password' => 'Пароль введен не верно')
            }

            Auth::auth($user, $this->request->post('remember'));

            $this->redirect('/dashboard');
        }

        return $this->index();  // array('email' => 'Пользователя с таким email нет')
    }

    public function logout()
    {
        Auth::clear();

        Cookies::clear();

        $this->redirect('/');
    }
}