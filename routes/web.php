<?php

use core\Route;
use core\Request;

$request = new Request();
$router = new Route($request);




$router->get('/', 'PageController@index');

$router->get('/get/:name', 'PageController@store');

$router->post('/edit/post/:id', 'PageController@edit');



$router->run();