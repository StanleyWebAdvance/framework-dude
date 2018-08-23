<?php

use core\Route;
use core\Request;

$request = new Request();
$router = new Route($request);




$router->get('/', 'PageController@index');

$router->post('/get/:name', 'PageController@store');

$router->get('/edit/post/:id', 'PageController@edit');



$router->run();