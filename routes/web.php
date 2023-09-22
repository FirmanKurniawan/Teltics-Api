<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Product Routes
$router->get('/products', 'ProductController@index');
$router->post('/products', 'ProductController@store');
$router->get('/products/{id}', 'ProductController@show');
$router->put('/products/{id}', 'ProductController@update');
$router->delete('/products/{id}', 'ProductController@destroy');

// Service Routes
$router->get('/services', 'ServiceController@index');
$router->post('/services', 'ServiceController@store');
$router->get('/services/{id}', 'ServiceController@show');
$router->put('/services/{id}', 'ServiceController@update');
$router->delete('/services/{id}', 'ServiceController@destroy');
