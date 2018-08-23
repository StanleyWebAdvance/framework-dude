<?php

use core\Route;
use core\Request;

$request = new Request();
$router = new Route($request);


$router->get('/', 'PageController@index');

$router->get('/login', 'PageController@login');

$router->post('/login', 'PageController@admin');


$router->run();