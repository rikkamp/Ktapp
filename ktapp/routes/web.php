<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('/', 'LoginController@index');
Route::post('/checklogin', 'LoginController@checklogin');
Route::get('/home', ['as' => 'home', 'uses' => 'LoginController@successlogin']);
Route::get('/loggout', ['as' => 'loggout', 'uses' => 'LoginController@loggout']);
Route::post('/gegevensGet', ['as' => 'gegevensGet', 'uses' => 'gegevensController@get']);
Route::put('/gegevens', ['as' => 'gegevensPut', 'uses' => 'gegevensController@create']);
Route::post('/gegevens', ['as' => 'gegevensPost', 'uses' => 'gegevensController@update']);
Route::post('/gegevensDelete', ['as' => 'gegevensDelete', 'uses' => 'gegevensController@archive']);
Route::post('/gegevens/pdf', ['as' => 'gegevensPdf', 'uses' => 'gegevensController@pdf']);

