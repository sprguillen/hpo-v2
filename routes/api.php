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
Route::namespace('Api')->group(function() {

    //** Auth routes
    Route::prefix('auth')->namespace('Auth')->group(function() {
        Route::post('login', 'AuthController@login')->name('login');
        Route::post('register', 'AuthController@register')->name('register');

        Route::prefix('password/reset')->group(function() {
            Route::post('', 'PasswordController@resetPassword')->name('reset.password');
            Route::post('send', 'PasswordController@sendResetPassword')->name('send.reset.password');
        });

    });

    /**
     * Admin Routes
     */
    Route::middleware('auth')->group(function() {
        Route::prefix('admin')
            ->middleware('admin')
            ->namespace('Admin')->group(function() {

            // Client
            Route::prefix('client')->group(function() {
                Route::name('api.admin.client')->get('', 'ClientController@index');
                Route::name('api.admin.client.store')->post('store', 'ClientController@store');
                Route::name('api.admin.client.update')->post('{id}/update', 'ClientController@update');
                Route::name('api.admin.client.destroy')->post('{id}/destroy', 'ClientController@destroy');
            });

            // Processor
            Route::prefix('processor')->group(function() {
                Route::name('api.admin.processor')->get('', 'ProcessorController@index');
                Route::name('api.admin.processor.store')->post('store', 'ProcessorController@store');
                Route::name('api.admin.processor.update')->post('{id}/update', 'ProcessorController@update');
                Route::name('api.admin.processor.destroy')->post('{id}/destroy', 'ProcessorController@destroy');
            });
        });
    });

});


// Sources
Route::post('source/add', 'API\SourceController@add');

// Dispatchers
Route::post('dispatcher/add', 'API\DispatcherController@add');

// Patients
Route::post('patient/type/add', 'API\PatientController@addType');

// Services
Route::post('service/add', 'API\ServiceController@add');
