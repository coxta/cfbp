<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

// Utilities
use App\View\Components\Utilities\Button;
use App\View\Components\Utilities\Loader;
use App\View\Components\Utilities\Container;

class ComponentServiceProvider extends ServiceProvider
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
        /**
         * -------------------------------------------
         * Register some nice, reusable component tags
         * -------------------------------------------
         */

        // Utilities
        Blade::component('button', Button::class);
        Blade::component('loader', Loader::class);
        Blade::component('container', Container::class);

    }
}