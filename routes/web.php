<?php

use core\Route;


$router = new Route();




$router->addRoute('/', function (){
    echo 'main';
});



$router->addRoute('/fff/:name', function (){
    echo 'page fff';
});




$router->run();