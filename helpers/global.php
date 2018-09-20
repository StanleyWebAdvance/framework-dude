<?php

use core\request\Request;

if (! function_exists('old')) {

    function old($key)
    {
        return (new Request())->post($key);
    }
}