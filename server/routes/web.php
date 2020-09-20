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

$router->post('auth/login', ['as' => 'auth.login', 'uses' => 'AuthController@login']);
$router->post('user', ['as' => 'user.create', 'uses' => 'UserController@create']);

$router->get('boards', ['as' => 'boards.index', 'uses' => 'BoardController@index']);
$router->get('boards/{boardUrl}', ['as' => 'board-posts.index', 'uses' => 'BoardPostsController']);

$router->get('boards/{boardUrl}/{post}', ['as' => 'posts.index', 'uses' => 'PostController@index']);
$router->get('posts/{post}', ['as' => 'posts.show', 'uses' => 'PostController@show']);

$router->group(['middleware' => 'auth:api'], function () use ($router) {
    $router->post('auth/logout', ['as' => 'auth.logout', 'uses' => 'AuthController@logout']);
    $router->post('auth/refresh', ['as' => 'auth.refresh', 'uses' => 'AuthController@refresh']);
});
