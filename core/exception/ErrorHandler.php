<?php

namespace core\exception;

class ErrorHandler extends \Exception
{
    private $errors = array(

        E_ERROR             => 'ERROR',
        E_WARNING           => 'WARNING',
        E_PARSE             => 'PARSE',
        E_NOTICE            => 'NOTICE',
        E_CORE_ERROR        => 'CORE_ERROR',
        E_CORE_WARNING      => 'CORE_WARNING',
        E_COMPILE_ERROR     => 'COMPILE_ERROR',
        E_COMPILE_WARNING   => 'COMPILE_WARNING',
        E_USER_ERROR        => 'USER_ERROR',
        E_USER_WARNING      => 'USER_WARNING',
        E_USER_NOTICE       => 'USER_NOTICE',
        E_STRICT            => 'STRICT',
        E_RECOVERABLE_ERROR => 'RECOVERABLE_ERROR',
        E_DEPRECATED        => 'DEPRECATED',
        E_USER_DEPRECATED   => 'USER_DEPRECATED',
    );

    private  $status_codes = array (

        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        307 => 'Temporary Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        422 => 'Unprocessable Entity',
        423 => 'Locked',
        424 => 'Failed Dependency',
        426 => 'Upgrade Required',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates',
        507 => 'Insufficient Storage',
        509 => 'Bandwidth Limit Exceeded',
        510 => 'Not Extended'
    );

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

