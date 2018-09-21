<?php namespace app\requests;

use core\request\FormRequest;

class FileRequest extends FormRequest
{
    public $rulesFile = array(

        'image' => array(

            'type' => 'file',
            'required' => true
        ),
    );
}