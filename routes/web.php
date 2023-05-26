<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/',                       'CustomerController@index');
$router->get('/customers',              'CustomerController@index');
$router->get('/customers/{id}',         'CustomerController@show');

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/customers',          'CustomerApiController@index');
    $router->get('/customers/{id}',     'CustomerApiController@show');
});
