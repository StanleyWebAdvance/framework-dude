<?php

use core\route\Route;
use core\request\Request;

$request = new Request();
$router = new Route($request);


$router->get('/', 'PageController@index');

$router->get('/login', 'PageController@login');

$router->post('/login', 'PageController@enter');

$router->get('/admin', 'PageController@admin', 'Page');


$router->run();
