<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([ 'prefix' => 'auth'], function (){
    Route::group(['middleware' => ['guest:api']], function () {
        Route::post('login', 'Api\AuthController@login');
        Route::post('signup', 'Api\AuthController@signup');
    });
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'Api\AuthController@logout');
        Route::post('getuser', 'Api\AuthController@getUser');
    });
});
Route::post('upload', 'PostConroller@uploadImages');
$router->group(['middleware' => 'auth:api'], function($router) {
    $router->get('list', 'PostController@index');
    $router->get('search/{keyword}', 'AuthController@search');
    $router->post('post', 'PostController@store');
    $router->post('comment', 'CommentController@store');
    $router->post('reaction', 'ReactionController@store');
    $router->post('follow', 'FollowingController@store');
    $router->post('approve', 'FollowingController@approve');
    $router->post('reject', 'FollowingController@reject');
    $router->post('block', 'BlockController@store');
});
