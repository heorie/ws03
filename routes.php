<?php

use Framework\Router;

/** @var Router $router */

// Home
$router->get('/', 'HomeController@index');

// Listings
$router->get('/listings',              'ListingController@index');
$router->get('/listings/create',       'ListingController@create');
$router->post('/listings',             'ListingController@store');
$router->get('/listings/{id}',         'ListingController@show');
$router->get('/listings/{id}/edit',    'ListingController@edit');
$router->put('/listings/{id}',         'ListingController@update');
$router->delete('/listings/{id}',      'ListingController@destroy');

// Auth
$router->get('/login',                 'UserController@login');
$router->post('/login',                'UserController@authenticate');
$router->get('/register',              'UserController@register');
$router->post('/register',             'UserController@store');
$router->get('/logout',                'UserController@logout');
