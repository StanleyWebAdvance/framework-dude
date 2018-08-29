<?php namespace app\requests;

use core\request\FormRequest;

class FileRequest extends FormRequest
{
    public $rules = array(

        'image' => array(

            'type' => 'file',
            'required' => true
        ),
    );
}