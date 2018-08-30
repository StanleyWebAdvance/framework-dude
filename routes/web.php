<?php

//  Подключаем роутер
$router = new core\route\Route();



//  Прописываем роуты приложения их методы и мидлевары

$router->get('/', 'PageController@index');
$router->get('/login', 'PageController@login');
$router->get('/registration', 'PageController@registration');

$router->get('/admin', 'PageController@admin', 'admin');
$router->get('/logout', 'PageController@logout', 'admin');


//  Запускаем роутер
$router->run();
