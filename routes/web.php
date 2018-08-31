<?php

//  Подключаем роутер
$router = new core\route\Route();

/**********************************************************************************
 *
 *              Прописываем роуты приложения их методы и мидлеверы
 *
 *     $router->метод('uri', 'ИмяКонтроллера@методКонтроллера', 'ИмяМиделвера')
 *
 ***********************************************************************************/


$router->get('/', 'IndexController@index');

$router->get('/login', 'LoginController@index');
$router->post('/login', 'LoginController@login');
$router->get('/logout', 'LoginController@logout', 'dashboard');

$router->get('/registration', 'RegistrationController@index');
$router->post('/registration', 'RegistrationController@registration');

//$router->get('/dashboard', 'DashboardController@admin', 'dashboard');




//  Запускаем роутер
$router->run();
