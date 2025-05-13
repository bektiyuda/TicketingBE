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
    $router->post('/', 'TicketOrderController@store');
    $router->put('/{id}', 'TicketOrderController@update');
    $router->delete('/{id}', 'TicketOrderController@destroy');
});

// Route untuk genre
$router->group(['prefix' => 'genres'], function () use ($router) {
    $router->get('/', 'GenreController@index');
    $router->get('/{id}', 'GenreController@show');
    $router->post('/', 'GenreController@store');
    $router->put('/{id}', 'GenreController@update');
    $router->delete('/{id}', 'GenreController@destroy');
});

// Route untuk city
$router->group(['prefix' => 'cities'], function () use ($router) {
    $router->get('/', 'CityController@index');
    $router->get('/{id}', 'CityController@show');
    $router->post('/', 'CityController@store');
    $router->put('/{id}', 'CityController@update');
    $router->delete('/{id}', 'CityController@destroy');
});

// Route untuk venue
$router->group(['prefix' => 'venues'], function () use ($router) {
    $router->get('/', 'VenueController@index');
    $router->get('/{id}', 'VenueController@show');
    $router->post('/', 'VenueController@store');
    $router->put('/{id}', 'VenueController@update');
    $router->delete('/{id}', 'VenueController@destroy');
});

// Route OAuth Google
$router->get('/auth/redirect', 'AuthController@redirectToGoogle');
$router->get('/auth/callback', 'AuthController@handleGoogleCallback');
$router->get('/login-google', function () {
    return view('oauth'); // resources/views/oauth.blade.php
});