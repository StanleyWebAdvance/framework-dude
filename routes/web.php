<?php

//  Подключаем роутер
$router = new core\route\Route();



//  Прописываем роуты приложения их методы и мидлевары

$router->get('/', 'PageController@index');
$router->get('/login', 'PageController@login');
$router->get('/registration', 'PageController@registration');


//  Запускаем роутер
$router->run();
