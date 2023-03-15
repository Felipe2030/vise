<?php

// GET
$router->get('/', 'Login@index');
$router->get('/home', 'Home@index');

// POST
$router->post('/login', 'Login@store');


// $router->get('/formulario', 'Home@formulario');
// $router->post('/login', 'Login@store');
// $router->get('/post/{slug}', 'Post@show');
// $router->get('/login', 'Login@index');
// $router->post('/login', 'Login@store');
// $router->get('/logout', 'Login@destroy');
// $router->get('/protect',['middleware' => 'loggedIn', 'uses' => 'Protect@index']);