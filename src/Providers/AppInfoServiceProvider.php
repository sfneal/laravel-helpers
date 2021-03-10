<?php

namespace Sfneal\Helpers\Laravel\Providers;

use Illuminate\Support\ServiceProvider;

class AppInfoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any AppInfoServiceProvider services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config file
        $this->publishes([
            __DIR__.'/../../config/app-info.php' => config_path('app-info.php'),
        ], 'config');
    }

    /**
     * Register any AppInfoServiceProvider services.
     *
     * @return void
     */
    public function register()
    {
        // Load config file
        $this->mergeConfigFrom(__DIR__.'/../../config/app-info.php', 'app-info');
    }
}
