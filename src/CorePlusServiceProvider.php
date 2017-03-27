<?php

namespace LaravelEnso\CorePlus;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class CorePlusServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    private $providers = [
        'LaravelEnso\CnpValidator\CnpValidatorServiceProvider',
        'LaravelEnso\DocumentsManager\DocumentsManagerServiceProvider',
        'LaravelEnso\CommentsManager\CommentsManagerServiceProvider',
        'Jenssegers\Date\DateServiceProvider',
    ];

    public function boot()
    {
        $this->publishesResources();
        $this->publishesClasses();
        $this->loadDependencies();
    }

    private function publishesResources()
    {
        $this->publishes([
            __DIR__.'/database/migrations' => database_path('migrations'),
        ], 'coreplus-migrations');

        $this->publishes([
            __DIR__.'/resources/views/pages' => resource_path('views/vendor/laravel-enso/core/pages'),
        ], 'coreplus-views');

        $this->publishes([
            __DIR__.'/resources/assets/main-js' => resource_path('assets/js'),
        ], 'coreplus-main-js');
    }

    private function publishesClasses()
    {
        $this->publishes([
            __DIR__.'/resources/Classes/DataTable' => app_path('DataTable'),
        ], 'coreplus-classes');

        $this->publishes([
            __DIR__.'/resources/Classes/Controllers' => app_path('Http/Controllers'),
        ], 'coreplus-controllers');

        $this->publishes([
            __DIR__.'/resources/Classes/Requests' => app_path('Http/Requests'),
        ], 'coreplus-requests');

        $this->publishes([
            __DIR__.'/resources/Classes/Models' => app_path(),
        ], 'coreplus-models');
    }

    private function loadDependencies()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'laravel-enso/core');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }

        $loader = AliasLoader::getInstance();
        $loader->alias('Date', 'Jenssegers\Date\Date');
    }
}
