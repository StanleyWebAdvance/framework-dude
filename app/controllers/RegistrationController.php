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

        $mUser = new UsersModel();

        $mUser->fillable = array(

            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'password' => $mUser->cryptPassword($request->post('password')),
        );

        $mUser->insert();

        Auth::auth(
            array(

                'id'    => $mUser::getLastId(),
                'email' => $request->post('email'),
                'name'  => $request->post('name')
            ),
            $request->post('remember')
        );

        $this->redirect('/dashboard');

        return true;
    }
}