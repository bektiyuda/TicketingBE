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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/register', 'AuthController@register');
$router->post('/login', 'AuthController@login');

$router->group(['prefix' => 'concerts'], function () use ($router) {
    $router->get('/', 'ConcertController@index');           
    $router->get('/{id}', 'ConcertController@show');        
    $router->post('/', 'ConcertController@store');          
    $router->put('/{id}', 'ConcertController@update');      
    $router->delete('/{id}', 'ConcertController@destroy');  
});

$router->group(['prefix' => 'tickets'], function () use ($router) {
    $router->get('/', 'TicketController@index');         
    $router->get('/{id}', 'TicketController@show');      
    $router->post('/', 'TicketController@store');        
    $router->put('/{id}', 'TicketController@update');    
    $router->delete('/{id}', 'TicketController@destroy');
});

$router->group(['prefix' => 'orders'], function () use ($router) {
    $router->get('/', 'OrderDetailController@index');
    $router->get('/{id}', 'OrderDetailController@show');
    $router->post('/', 'OrderDetailController@store');
    $router->put('/{id}', 'OrderDetailController@update');
    $router->delete('/{id}', 'OrderDetailController@destroy');
});

$router->group(['prefix' => 'ticket-orders'], function () use ($router) {
    $router->get('/', 'TicketOrderController@index');
    $router->get('/{id}', 'TicketOrderController@show');
});
