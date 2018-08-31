<?php

namespace core\exception;

use core\config\Config;
use Throwable;

class ErrorHandler extends \Exception
{
    private $errors = array();
    private  $status = array ();

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->errors = Config::errors();
        $this->status = Config::status();
    }

    /**
     *  регистрируем свои методы отлова и обработки ошибок
     */
    public function register()
    {
        // говорим php отслеживать все возможные ошибки
        ini_set('display_errors', 'on');
        error_reporting(E_ALL | E_STRICT);

        // регистрируем обработчик ошибок
        set_error_handler([$this, 'errorHandler']);

        // ловим выброшеные исключения
        set_exception_handler([$this, 'exceptionHandler']);

        // ловим фатальные ошибки
        register_shutdown_function([$this, 'fatalHandler']);
    }

    /** обработчик ошибок
     *
     * @param $eNumber
     * @param $eMessage
     * @param $eFile
     * @param $eLine
     * @return bool
     */
    public function errorHandler($eNumber, $eMessage, $eFile, $eLine)
    {
        $this->showError($eNumber, $eMessage, $eFile, $eLine, 'Error');
        return true;
    }

    /** обработчик исключений
     *
     * @param \Exception $e
     */
    public function exceptionHandler(\Exception $e)
    {
        $this->showError(get_class($e), $e->getMessage(), $e->getFile(), $e->getLine(), 'Exception');
    }

    /** обработчик фатальных ошибок
     *
     *
     */
    public function fatalHandler()
    {
        $error = error_get_last();

        if (isset($error['type']) && $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)) {

            $this->showError($error['type'], $error['message'], $error['file'], $error['line'], 'Fatal');
        }
    }

    /** вывощдим ошибки на экран
     *
     * @param $eNumber
     * @param $eMessage
     * @param $eFile
     * @param $eLine
     * @param $caption
     * @param string $status
     */
    private function showError($eNumber, $eMessage, $eFile, $eLine, $caption, $status = '500')
    {
        //todo почему-то не могу передать заголовки
//        header("HTTP/1.1 " . $status);
//        header($_SERVER['SERVER_PROTOCOL'] . ' Internal Server Error', true, 500);

        echo "<meta charset='UTF-8'>";
        echo "<pre>";
        echo "<div class='background-exception'>";
        echo "<div class='caption-exception'> " . $caption . " | " . $this->getErrorName($eNumber) . " </div><br>";
        echo "<div class='message-exception'>" . $eMessage . "</div>";
        echo "<hr><br>";
        echo "<div class='file-exception'>" . "Ошибка вызвана в файле - " . $eFile . "</div>";
        echo "<div class='string-exception'>" . "На строке - " . $eLine . "</div><br>";
//        echo "<div class='string-exception'>" . "Трассировка : <br>" . $this->getTraceAsString() . "</div>";
        echo "</pre>";
        echo "</div>";

        echo "
        <style>
        hr{
            background-color: white;
        }
        .background-exception{
            color:#fff; 
            font-family: Monospaced, monospace; 
            background: #282826; 
            font-size: 14px; 
            border: 1px dotted #c0c0c0; 
            padding: 10px
        }
        .caption-exception{
            font-size: 30px;
        }
        .message-exception{
            color:#fa2772;
            font-size: 20px;
        }
        .file-exception{
            color:#36af90;
        }
        .string-exception{
            color:#36af90;
        }
        </style>
        ";
    }

    /** получаем имя ошибки
     *
     * @param $eNumber
     * @return string
     */
    private function getErrorName($eNumber)
    {
        if(array_key_exists($eNumber, $this->errors)){
            return $this->errors[$eNumber] . " [$eNumber]";
        }
        return $eNumber;
    }

    private function writeLogs()
    {
        //todo написать запись ошибок в логи
    }

}

