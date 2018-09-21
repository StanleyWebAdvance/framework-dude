<?php namespace app\requests;

use core\request\FormRequest;

class LoginRequest extends FormRequest
{
    public $rulesPost = array(

        'captcha' => false,

        'email' => array(

            'name' => 'email',
            'type' => 'email',
            'required' => true
        ),

        'password' => array(

            'type' => 'password',
            'name' => 'пароль',
            'required' => true
        ),

        'remember' => array(

            'type' => 'remember',
        ),
    );
}