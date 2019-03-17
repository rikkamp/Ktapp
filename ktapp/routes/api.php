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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/checklogin', 'LoginController@checklogin');
Route::get('/user', 'gegevensController@get');
Route::put('/user', 'gegevensController@create');
Route::post('/user', 'gegevensController@update');
Route::delete('/user', 'gegevensController@archive');
