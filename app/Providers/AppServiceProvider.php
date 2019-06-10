<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Batch;
use App\Models\Patient;
use App\Observers\UserObserver;
use App\Observers\BatchObserver;
use App\Observers\PatientObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Batch::observe(BatchObserver::class);
        Patient::observe(PatientObserver::class);
    }
}
