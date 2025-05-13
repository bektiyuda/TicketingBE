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