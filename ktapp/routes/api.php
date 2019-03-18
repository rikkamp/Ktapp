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
Route::get('/gegevens', 'gegevensController@get');
Route::put('/gegevens', 'gegevensController@create');
Route::post('/gegevens', 'gegevensController@update');
Route::delete('/gegevens', 'gegevensController@archive');
Route::get('/gegevens/pdf', 'gegevensController@pdf');
