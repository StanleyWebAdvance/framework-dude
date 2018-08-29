<?php

//  Подключаем роутер
$router = new core\route\Route();



//  Прописываем роуты приложения их методы и мидлевары

$router->get('/', 'PageController@index');

$router->get('/login', 'PageController@login');

$router->post('/login', 'PageController@enter');

$router->get('/admin', 'PageController@admin', 'Page');

$router->post('/upload/image', 'FileController@upload');



//  Запускаем роутер
$router->run();
