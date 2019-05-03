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
        Route::name('login')->post('login', 'AuthController@login');
        Route::name('register')->post('register', 'AuthController@register');

        Route::prefix('reset/password')->group(function() {
            Route::name('reset.password.send')->post('send', 'PasswordController@sendResetPassword');
            Route::name('reset.password.form')->post('{token}/form', 'PasswordController@resetPasswordForm');
            Route::name('reset.password')->post('', 'PasswordController@resetPassword');
        });

    });

    /**
     * Authenticated Users Routes
     */
    Route::middleware('auth:api')->group(function() {

        /**
         * User routes
         */
        Route::prefix('user')->namespace('User')->group(function() {
            Route::name('api.user.me')->get('me', 'IndexController@index');
        });

        /**
         * Admin Routes
         */
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

        Route::name('api.user.token')->get('auth/user/token', 'Auth\AuthController@userToken');
    });

});
