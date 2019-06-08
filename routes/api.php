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
Route::namespace('Api')->middleware(['checkIp'])->group(function() {

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
        Route::prefix('client')->namespace('Client')->middleware('client')->group(function() {

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

            // Client staff routes
            Route::prefix('staff')->group(function() {
                Route::name('api.client.staff')->get('', 'StaffController@index');
                Route::name('api.client.staff.store')->post('store', 'StaffController@store');
                Route::name('api.client.staff.update')->post('{id}/update', 'StaffController@update');
                Route::name('api.client.staff.archive')->post('{id}/archive', 'StaffController@archive');
                Route::name('api.client.staff.search')->get('search/{key}', 'StaffController@search');
            });

            // Client Patient routes
            Route::prefix('patient')->group(function() {
                Route::name('api.client.patient')->get('', 'PatientController@index');
                Route::name('api.client.patient.store')->post('store', 'PatientController@store');
                Route::name('api.client.patient.update')->post('{id}/update', 'PatientController@update');
                Route::name('api.client.patient.archive')->post('{id}/archive', 'PatientController@archive');
                Route::name('api.client.patient.search')->get('search/{key}', 'PatientController@search');
            });

        });

        /**
         * Admin Routes
         */
        Route::prefix('admin')
            ->middleware('admin')
            ->namespace('Admin')->group(function() {

            // Client
            Route::prefix('client')->namespace('Client')->group(function() {
                Route::name('api.admin.client')->get('', 'IndexController@index');
                Route::name('api.admin.client.store')->post('store', 'IndexController@store');
                Route::name('api.admin.client.update')->post('{id}/update', 'IndexController@update');
                Route::name('api.admin.client.destroy')->post('{id}/destroy', 'IndexController@destroy');
                Route::name('api.admin.client.search')->get('search/{key}', 'IndexController@search');

                //** Manage individual `clients`
                Route::name('api.admin.client.details')->get('details/{code}', 'IndexController@details');
                Route::name('api.admin.client.update.payment_mode')->post('payment_mode/{code}/update', 'IndexController@updatePaymentMode');

                //** Manage client sources
                Route::prefix('{id}/sources')->group(function() {
                    Route::name('api.admin.client.sources')->get('', 'SourcesController@index');
                    Route::name('api.admin.client.sources.store')->post('store', 'SourcesController@store');
                    Route::name('api.admin.client.sources.destroy')->post('{sourceId}/destroy', 'SourcesController@destroy');
                });
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

                // Manage PatientType
                Route::prefix('patient-type')->group(function() {
                    Route::name('api.admin.system.patient_type')->get('', 'PatientTypeController@index');
                    Route::name('api.admin.system.patient_type.store')->post('store', 'PatientTypeController@store');
                    Route::name('api.admin.system.patient_type.update')->post('{id}/update', 'PatientTypeController@update');
                    Route::name('api.admin.system.patient_type.destroy')->post('{id}/destroy', 'PatientTypeController@destroy');
                });

                // Manage WhitelistIps
                Route::prefix('white-listed-ip')->group(function() {
                    Route::name('api.admin.system.white_listed_ip')->get('', 'WhiteListedIpController@index');
                    Route::name('api.admin.system.white_listed_ip.store')->post('store', 'WhiteListedIpController@store');
                    Route::name('api.admin.system.white_listed_ip.update')->post('{id}/update', 'WhiteListedIpController@update');
                    Route::name('api.admin.system.white_listed_ip.destroy')->post('{id}/destroy', 'WhiteListedIpController@destroy');
                });
            });
        });

        Route::name('api.user.token')->get('auth/user/token', 'Auth\AuthController@userToken');
    });

});
