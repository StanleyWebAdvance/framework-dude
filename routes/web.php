<?php

use core\Route;
use core\Request;

$request = new Request();
$router = new Route($request);




$router->get('/', 'PageController@index');



$router->get('/get', 'PageController@edit');




$router->run();