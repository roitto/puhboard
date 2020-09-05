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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

/*
 * Authorization routes
 */
$router->post('user/create', ['as' => 'user.create', 'uses' => 'UserController@create']);
$router->post('auth/login', ['as' => 'auth.login', 'uses' => 'AuthController@login']);

$router->group(['middleware' => 'auth:api'], function () use ($router) {
    $router->post('auth/logout', ['as' => 'auth.logout', 'uses' => 'AuthController@logout']);
    $router->post('auth/refresh', ['as' => 'auth.refresh', 'uses' => 'AuthController@refresh']);
});
