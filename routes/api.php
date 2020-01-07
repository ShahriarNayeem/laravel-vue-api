<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//all article
Route::get('/articles', 'ArticleController@index');

//single
Route::get('/article/{id}', 'ArticleController@show');

//create
Route::post('/article', 'ArticleController@store');

//Update
Route::put('/article/{id}', 'ArticleController@update');

//delete
Route::delete('/article/{id}', 'ArticleController@destroy');
