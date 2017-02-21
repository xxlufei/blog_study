<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
/*$app->group(['namespace' => 'App\Http\Controllers'], function ($app) {
    //创建直播
    $app->get('/', function(){
        echo 123;
    });
});*/
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['namespace' => 'Admin', 'prefix'=>'admin'], function () {

    Route::post('/login', 'LoginController@login');
    Route::get('/objectlist', 'ObjectController@object_list');
    Route::get('/objectlistall', 'ObjectController@object_list_all');
    Route::delete('/object_delete', 'ObjectController@object_delete');
    Route::post('/object_add', 'ObjectController@object_add');
    Route::post('/object_update', 'ObjectController@object_update');

    Route::get('/messagelist', 'MessageController@message_list');
    Route::delete('/message_delete', 'MessageController@message_delete');
    Route::post('/message_add', 'MessageController@message_add');
    Route::post('/message_update', 'MessageController@message_update');

    Route::get('/filelist', 'FileController@file_list');
    Route::delete('/file_delete', 'FileController@file_delete');
    Route::post('/file_add', 'FileController@file_add');
});




    Route::get('/', 'IndexController@index');
    Route::get('/login', 'LoginController@login');
    Route::post('/login', 'LoginController@login1');
    Route::get('/logout', 'LoginController@logout');
    Route::get('/register', 'LoginController@register');
    Route::post('/register', 'LoginController@register1');


    Route::get('/objectlist', 'ObjectController@object_list');
    Route::delete('/object_delete', 'ObjectController@object_delete');
    Route::post('/object_add', 'ObjectController@object_add');
    Route::post('/object_update', 'ObjectController@object_update');

    Route::get('/messagelist', 'MessageController@message_list');
    Route::delete('/message_delete', 'MessageController@message_delete');
    Route::post('/message_add', 'MessageController@message_add');
    Route::post('/message_update', 'MessageController@message_update');

    Route::get('/filelist', 'FileController@file_list');
    Route::delete('/file_delete', 'FileController@file_delete');
    Route::post('/file_add', 'FileController@file_add');


    Route::get('/messages', 'MessageController@messages');
    Route::post('/message', 'MessageController@message_add');


    Route::get('/download', 'DownloadController@down_list');


