<?php

namespace app\requests;

use core\FormRequest;

class PageRequest extends FormRequest
{

    public function rules()
    {

        $this->rules = array(

            'name' => array(

                'type' => 'text',
                'min' => 5,
                'max' => 150,
                'required' => true
            ),

        );


    }

}