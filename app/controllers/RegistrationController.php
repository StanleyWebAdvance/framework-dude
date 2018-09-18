<?php 
namespace app\controllers;

use app\models\UsersModel;
use app\requests\RegistrationRequest;
use core\session\Auth;
use core\template\Controller;

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

        $user = new UsersModel();

        $user->fillable = array(

            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'password' => $user->cryptPassword($request->post('password')),
        );

        $user->insert();

        Auth::authSession(
            array(

                'id'    => $user::getLastId(),
                'email' => $request->post('email'),
                'name'  => $request->post('name')
            )
        );

        $this->redirect('/dashboard');

        return true;
    }
}