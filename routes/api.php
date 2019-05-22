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
            Route::name('reset.password.form')->get('{token}/form', 'PasswordController@resetPasswordForm');
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
         * Client routes
         */
        Route::prefix('client')->namespace('Client')->group(function() {

            /**
             * Batch routes
             */
            Route::prefix('batch')->group(function() {
                Route::name('api.client.batch')->get('', 'BatchController@index');
                Route::name('api.client.batch.store')->post('store', 'BatchController@store');
                Route::name('api.client.batch.update')->post('{id}/update', 'BatchController@update');
                Route::name('api.client.batch.destroy')->post('{id}/destroy', 'BatchController@destroy');
                Route::name('api.client.batch.search')->get('search/{key}', 'BatchController@search');
            });

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
                Route::name('api.admin.client.search')->get('search/{key}', 'ClientController@search');

                //** Manage individual `clients`
                Route::name('api.admin.client.details')->get('details/{code}', 'ClientController@details');
                Route::name('api.admin.client.update.payment_mode')->post('payment_mode/{code}/update', 'ClientController@updatePaymentMode');
            });

            // Processor
            Route::prefix('processor')->group(function() {
                Route::name('api.admin.processor')->get('', 'ProcessorController@index');
                Route::name('api.admin.processor.search')->get('search/{key}', 'ProcessorController@search');
                Route::name('api.admin.processor.store')->post('store', 'ProcessorController@store');
                Route::name('api.admin.processor.update')->post('{id}/update', 'ProcessorController@update');
                Route::name('api.admin.processor.destroy')->post('{id}/destroy', 'ProcessorController@destroy');
            });

            // Services
            Route::prefix('services')->namespace('Service')->group(function() {
                Route::name('api.admin.services')->get('', 'IndexController@index');
                Route::name('api.admin.services.search')->get('search/{key}', 'IndexController@search');
                Route::name('api.admin.services.store')->post('store', 'IndexController@store');
                Route::name('api.admin.services.update')->post('{id}/update', 'IndexController@update');
                Route::name('api.admin.services.destroy')->post('{id}/destroy', 'IndexController@destroy');
                Route::name('api.admin.service.details')->get('details/{code}', 'IndexController@details');
                Route::name('api.admin.service.import')->post('import', 'IndexController@import');

                // Client servies routes
                Route::prefix('client')->group(function() {
                    Route::name('api.admin.service.client.store')->post('store', 'ClientController@store');
                    Route::name('api.admin.service.client.update')->post('{id}/update', 'ClientController@update');
                    Route::name('api.admin.service.client.destroy')->post('{id}/destroy', 'ClientController@destroy');
                });

            });

            // System
            Route::prefix('system')->namespace('System')->group(function() {

                // Source
                Route::prefix('source')->group(function() {
                    Route::name('api.admin.system.source')->get('', 'SourceController@index');
                    Route::name('api.admin.system.source.store')->post('store', 'SourceController@store');
                    Route::name('api.admin.system.source.update')->post('{id}/update', 'SourceController@update');
                    Route::name('api.admin.system.source.destroy')->post('{id}/destroy', 'SourceController@destroy');
                });

                // Dispatchers
                Route::prefix('dispatcher')->group(function() {
                    Route::name('api.admin.system.dispatcher')->get('', 'DispatcherController@index');
                    Route::name('api.admin.system.dispatcher.store')->post('store', 'DispatcherController@store');
                    Route::name('api.admin.system.dispatcher.update')->post('{id}/update', 'DispatcherController@update');
                    Route::name('api.admin.system.dispatcher.destroy')->post('{id}/destroy', 'DispatcherController@destroy');
                });

            });
        });

        Route::name('api.user.token')->get('auth/user/token', 'Auth\AuthController@userToken');
    });

});
