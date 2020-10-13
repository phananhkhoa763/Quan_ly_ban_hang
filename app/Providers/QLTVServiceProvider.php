<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class QLTVServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('viewdep', 'App\Http\ViewQLTV\viewQLTV');
    }
}
