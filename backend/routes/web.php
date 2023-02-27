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


$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['middleware' => 'jwt'], function () use ($router) {
        $router->delete('user/', 'UserController@delete');
        $router->get('revoke/', 'UserController@refresh');
        $router->group(['prefix' => 'link'], function () use ($router) {
            $router->post('/', 'LinkController@create');
            $router->get('/', 'LinkController@list');
            $router->delete('/{id}', 'LinkController@delete');
            $router->put('/{id}', 'LinkController@update');
            $router->delete('child/{idChild}/{idBase}', 'LinkController@deleteChild');
            $router->put('child/{idChild}/{idBase}', 'LinkController@updateChild');
            $router->post('acess/{idChild}/{idBase}', 'LinkController@acess');
        });
    });
    $router->post('register', 'UserController@register');
    $router->post('login', 'UserController@login');
});