<?php

namespace app\requests;

use core\request\FormRequest;

class PageRequest extends FormRequest
{
    public $rules = array(

            'name' => array(

                'type' => 'text',
                'min' => 5,
                'max' => 150,
                'required' => true
            ),
    );
}