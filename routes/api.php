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
Route::prefix('auth')->namespace('Api')->group(function() {
  Route::post('register', 'AuthController@register')->name('register');
  Route::post('login', 'AuthController@login')->name('login');
});


// Sources
Route::post('source/add', 'API\SourceController@add');

// Dispatchers
Route::post('dispatcher/add', 'API\DispatcherController@add');

// Patients
Route::post('patient/type/add', 'API\PatientController@addType');

// Services
Route::post('service/add', 'API\ServiceController@add');
