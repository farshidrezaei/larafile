<?php

namespace FarshidRezaei\LaraFile\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class LaraFileServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // make root directory  if not exist.
        File::ensureDirectoryExists(config('larafile.root', 'larafile'));

        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes(
            [
                __DIR__ . '/../Config/larafile.php' => config_path('larafile.php'),
            ]
        );

        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang','larafile');

    }
}
