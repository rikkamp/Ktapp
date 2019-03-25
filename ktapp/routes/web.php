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
Route::get('/home', 'LoginController@successlogin');
Route::get('/loggout', 'LoginController@loggout');
Route::post('/gegevensGet', 'gegevensController@get');
Route::put('/gegevens', 'gegevensController@create');
Route::post('/gegevens', 'gegevensController@update');
Route::post('/gegevensDelete', 'gegevensController@archive');
Route::post('/gegevens/pdf', 'gegevensController@pdf');

