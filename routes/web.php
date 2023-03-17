<?php

// GET
$router->get('/', 'Index@login');
$router->get('/cadastrar','Index@cadastrar');
$router->get('/cadastrar/pessoas','Index@cadastrarPessoa');
$router->get('/cadastrar/pessoas/tipo','Index@cadastrarPessoaTipo');
$router->get('/recuperar', 'Index@recuperar');
$router->get('/redefinir/{token}', 'Index@redefinir');
$router->get('/logout', 'Usuarios@logout');
$router->get('/home',['middleware' => 'loggedIn', 'uses' => 'Home@index']);
$router->get('/home/pedidos',['middleware' => 'loggedIn', 'uses' => 'Home@pedido']);
$router->get('/home/modal/{page}',['middleware' => 'loggedIn', 'uses' => 'Index@modal']);

// POST
$router->post('/login', 'Usuarios@login');
$router->post('/recuperar', 'Usuarios@recuperar');
$router->post('/redefinir/{token}', 'Usuarios@redefinir');
$router->post('/cadastrar', 'Usuarios@cadastrar');
$router->post('/cadastrar/pessoas/{id}', 'Usuarios@cadastrarPessoa');
$router->post('/cadastrar/pessoas/tipo/{id}', 'Usuarios@cadastrarPessoaTipo');
$router->post('/usuarios/update/{id}', 'Usuarios@update');

// CONSULTAS
$router->get('/auth/usuario',['middleware' => 'loggedIn', 'uses' => 'Usuarios@getUsuarioLogado']);