<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', 'PagesController@index');

$router->get('/products', 'ProductsController@index');
$router->post('/products', 'ProductsController@create');
$router->get('/products/{id}', 'ProductsController@show');

$router->get('/stores', 'StoresController@index');

$router->get('/reviews', 'ReviewsController@index');