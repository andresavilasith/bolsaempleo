<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DefaultDataTestProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path() . '/Helpers/DefaultDataTest.php';

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
