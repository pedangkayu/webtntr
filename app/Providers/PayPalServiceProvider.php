<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Classes\PayPal\PayPal;

class PayPalServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->bind('PayPal', function(){
          return new PayPal;
      });
    }
}
