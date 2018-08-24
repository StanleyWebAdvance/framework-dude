<?php

namespace core;

class Validation
{
    /** проверка на капчу
     *
     * @param $data
     * @return bool
     */
    public function reCaptchaSuccess($data)
    {
        $configDB = new Config('.env');

        $url_to_google_api = "https://www.google.com/recaptcha/api/siteverify";
        $secret_key = $configDB->parseConfig('CAPTCHA_SECRET_KEY');
        $query = $url_to_google_api . '?secret=' . $secret_key . '&response=' . $data . '&remoteip=' . $_SERVER['REMOTE_ADDR'];
        $response = json_decode(file_get_contents($query));

        return ($response->success); // ? true : false;
    }

    /** проверка на наличие цифр в строке
     *
     * @param $str
     * @return bool
     */
    public function checkDigits($str)
    {
        return (!preg_match('~[0-9]~', $str)); // ? false : true;
    }

    /** проверка на наличие букв нижнего регистра
     *
     * @param $str
     * @return bool
     */
    public function checkLowercase($str)
    {
        return (!preg_match('~[a-z]~', $str)); // ? false : true;
    }

    /** проверка на наличие вукв верхнего регистра
     *
     * @param $str
     * @return bool
     */
    public function checkUppercase($str)
    {
        return (!preg_match('~[A-Z]~', $str)); // ? false : true;
    }

    /** проверка email
     *
     * @param $email
     * @return bool
     */
    public function checkEmail($email)
    {
        return (!filter_var($email, FILTER_VALIDATE_EMAIL)); // ? false : true;
    }

    /** проверка телефона
     *
     * @param $phone
     * @return bool
     */
    public function checkPhone($phone)
    {
        // удаляем лишнее
        $regExp = array('/\+/','/\(/','/\)/','/ /','/-/','/\*/','/\./','/,/');
        $phone = preg_replace($regExp, '', $phone);

        return (!preg_match('/^[^a-zA-Zа-яА-ЯёЁ]*$/', $phone)); // ? false : true;
    }

}