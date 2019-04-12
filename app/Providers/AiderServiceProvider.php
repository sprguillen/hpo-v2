<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\Aider;

class AiderServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->singleton('app.aider', function ($app) {
      return new Aider();
    });
    $this->app->alias('app.aider', Aider::class);
  }

  /**
   * Bootstrap services.
   *
   * @return void
   */
  public function boot()
  {
      //
  }
}
