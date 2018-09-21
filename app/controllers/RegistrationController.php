<?php 
namespace app\controllers;

use app\models\UsersModel;
use app\requests\RegistrationRequest;
use core\session\Auth;
use core\template\Controller;
use helpers\Crypt;
use helpers\Debug;

class RegistrationController extends Controller
{
    public function index()
    {
        return $this->view('admin/registration', array(

            'title' => 'Регистрация'
        ));
    }

    public function registration()
    {
        $this->request = new RegistrationRequest();

        if (!empty($this->request->getErrors())) {

            return $this->index();
        }

        $mUser = new UsersModel();

        $mUser->fillable = array(

            'name' => $this->request->post('name'),
            'email' => $this->request->post('email'),
            'password' => Crypt::password($this->request->post('password')),
        );

        $mUser->insert();

        Auth::auth(
            array(

                'id'    => $mUser::getLastId(),
                'email' => $this->request->post('email'),
                'name'  => $this->request->post('name')
            ),
            $this->request->post('remember')
        );

        $this->redirect('/dashboard');

        return true;
    }
}