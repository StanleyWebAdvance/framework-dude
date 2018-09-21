<?php namespace app\requests;

use core\request\FormRequest;

class RegistrationRequest extends FormRequest
{
    public $rulesPost = array(

        'name' => array(

            'name' => 'имя',
            'min' => 3,
            'max' => 150,
            'type' => 'name',
            'required' => true
        ),

        'email' => array(

            'name' => 'email',
            'type' => 'email',
            'required' => true
        ),

        'password' => array(

            'type' => 'password',
            'name' => 'пароль',
            'password-digits'       => true,
            'password-lowercase'    => true,
            'password-uppercase' => true,
            'min' => 6,
            'max' => 32,
            'required' => true
        ),

        'password-confirm' => array(

            'type' => 'password confirm',
            'name' => 'повтор пароля',
            'required' => true
        ),

        'remember' => array(

            'type' => 'remember',
        ),
    );
}