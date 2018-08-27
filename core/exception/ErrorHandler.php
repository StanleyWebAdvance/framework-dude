<?php

namespace core\exception;

use helpers\Debug;

class ErrorHandler extends \Exception
{
    public function logError()
    {
        //todo написать запись ошибок в логи

        $this->showException();
    }

    public function showException()
    {
        echo "<meta charset='UTF-8'>";
        echo "<pre>";
        echo "<div class='background-exception'>";
        echo "<div class='caption-exception'>Exception:</div><br>";
        echo "<div class='message-exception'>" . $this->getMessage() . "</div>";
        echo "<hr><br>";
        echo "<div class='file-exception'>" . "Ошибка вызвана в файле - " . $this->getFile() . "</div>";
        echo "<div class='string-exception'>" . "На строке - " . $this->getLine() . "</div><br>";
        echo "<div class='string-exception'>" . "Трассировка : <br>" . $this->getTraceAsString() . "</div>";
        echo "</pre>";
        echo "</div>";

        echo "
        <style>
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

    public function otherException($e)
    {

        //todo поймать здесь все не пойманые ошибки

        echo 'other';
    }
}

