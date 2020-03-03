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

// api mesma rota web com "api/" na rota
Route::post('registrar-usuario', 'API\UserController@registrar');
Route::post('login', 'API\UserController@login');

Route::middleware('auth:api')->get('usuario-detalhes', 'API\UserController@detalhesUser');
