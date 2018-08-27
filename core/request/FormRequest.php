<?php

namespace core\request;

use helpers\Debug;
use core\exception\ErrorHandler;

class FormRequest extends Request
{
    private $validation;
    private $message = array();
    private $answer = array();

    public function __construct()
    {
        parent::__construct();

        $this->validation = new Validation();

        $this->answer = include_once $_SERVER['DOCUMENT_ROOT'] . '/resources/lang/ru/validation.php';
    }

    /** валидация массива пост
     *
     * @return array
     */
    public function checkPost()
    {
        $this->message['error'] = false;
        $this->message['errors'] = array();
        $this->message['redirect'] = false;
        $this->message['ok'] = $this->answer['ok'];

        //  проверяем пришел ли токен
        if (($this->post('_token')) == null
                || $this->session('_token') == null
                    || !hash_equals($this->post('_token'), $this->session('_token'))) {

            throw new ErrorHandler('Токен не соответствует либо не создан (_token)');
        }

        //  запускаем цикл по полям правил валидации
        foreach ($this->rules as $nameRules => $rule) {

            //  проверяем поле на заполнение по правилу required
            if (isset($rule['required']) && $rule['required']){

                if (empty($this->post($nameRules))){

                    $this->message['error'] = true;
                    $this->message['errors']['required'] = $this->answer['required'];
                    break;
                }
            }

            //  проверяем телефон
            if (isset($rule['type']) && $rule['type'] == 'phone'){

                if (!$this->validation->checkPhone($this->post($nameRules))){

                    $this->message['error'] = true;
                    $this->message['errors']['phone'] = $this->answer['required'];
                    break;
                }
            }

            //  проверяем email
            if (isset($rule['type']) && $rule['type'] == 'email'){

                if (!$this->validation->checkEmail($this->post($nameRules))){

                    $this->message['error'] = true;
                    $this->message['errors']['email'] = $this->answer['required'];
                    break;
                }
            }

            //  проверяем на длинну
            if (isset($rule['max']) && $rule['max']){

                if(strlen($this->post($nameRules)) > $rule['max']){

                    $this->message['error'] = true;
                    $this->message['errors']['max'] = sprintf($this->answer['max'], $rule['max']);
                    break;
                }
            }

            //  проверяем на длинну
            if (isset($rule['min']) && $rule['min']){

                if(strlen($this->post($nameRules)) < $rule['min']){

                    $this->message['error'] = true;
                    $this->message['errors']['min'] = sprintf($this->answer['min'], $rule['min']);
                    break;
                }
            }

            //  проверка на капчу
            if (isset($rule['captcha']) && $rule['captcha']){

                //  пришла ли капча в массиве пост
                if ($this->post('g-recaptcha-response') != null) {

                    //  проверяем верна ли капча
                    if (!$this->validation->reCaptchaSuccess($this->post('g-recaptcha-response'))) {

                        $this->message['error'] = true;
                        $this->message['errors']['captcha'] = $this->answer['captcha'];
                    }
                } else {

                    $this->message['error'] = true;
                    $this->message['errors']['captcha'] = $this->answer['captchaNOT'];
                }
            }

            //  проверяем на подтверждение пароль
            if (isset($rule['type']) && $rule['type'] == 'password'){

                if ($this->post('password_confirm') != null){

                    if ($this->post('password') != $this->post('password_confirm')){

                        $this->message['error'] = true;
                        $this->message['errors']['password_confirm'] = $this->answer['password_confirm'];
                        break;
                    }
                }

            }

            //  проверка на наличие цыфр в пароле
            if (isset($rule['password_digits']) && $rule['password_digits']){

                if (!$this->validation->checkDigits($this->post('password'))){

                    $this->message['error'] = true;
                    $this->message['errors']['password_digits'] = $this->answer['password_digits'];
                    break;
                }
            }

            //  проверка на наличие нижнего регистра букв в пароле
            if (isset($rule['password_lowercase']) && $rule['password_lowercase']){

                if (!$this->validation->checkLowercase($this->post('password'))){

                    $this->message['error'] = true;
                    $this->message['errors']['password_lowercase'] = $this->answer['password_lowercase'];
                    break;
                }
            }

            //  проверка на наличие верхнего регистра букв в пароле
            if (isset($rule['password_uppercase']) && $rule['password_uppercase']){

                if (!$this->validation->checkUppercase($this->post('password'))){

                    $this->message['error'] = true;
                    $this->message['errors']['password_uppercase'] = $this->answer['password_uppercase'];
                    break;
                }
            }

            //  поле состоит только из цифр
            if (isset($rule['numeric']) && $rule['numeric']){

                //  todo написать проверку на цифры
            }

        }

        return $this->message;
    }




    public function checkFiles()
    {

    }

}