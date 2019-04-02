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

// Authentication
Route::post('auth/register', 'AuthController@register');
Route::post('auth/login', 'AuthController@login')->name('login');

// Sources
Route::post('source/add', 'SourceController@add');
