<?php

use core\Route;


$router = new Route();




$router->addRoute('/', function (){
    echo 'main';
});



$router->addRoute('/fff', function (){
    echo 'page fff';
});




$router->run();