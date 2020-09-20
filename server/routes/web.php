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
$router->post('user', ['as' => 'user.create', 'uses' => 'CreateUsersController']);

$router->get('boards', ['as' => 'boards.index', 'uses' => 'ListBoardsController']);
$router->get('boards/{boardUrl}', ['as' => 'board-posts.index', 'uses' => 'ListBoardPostsController']);

$router->get('posts/{postId}', ['as' => 'posts.show', 'uses' => 'ShowPostsController']);

$router->group(['middleware' => 'auth:api'], function () use ($router) {
    $router->post('auth/logout', ['as' => 'auth.logout', 'uses' => 'AuthController@logout']);
    $router->post('auth/refresh', ['as' => 'auth.refresh', 'uses' => 'AuthController@refresh']);
});
