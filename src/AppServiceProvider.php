<?php

namespace LaravelEnso\CorePlus;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishesAll();
        $this->loadDependencies();
    }

    private function publishesAll()
    {
        $this->publishes([
            __DIR__.'/database/migrations' => database_path('migrations'),
        ], 'core-migrations');

        $this->publishes([
            __DIR__.'/resources/views/pages' => resource_path('views/vendor/laravel-enso/core/pages'),
        ], 'core-views');

        $this->publishesClasses();
    }

    private function publishesClasses()
    {
        $this->publishes([
            __DIR__.'/resources/Classes/DataTable' => app_path('DataTable'),
        ], 'core-classes');

        $this->publishes([
            __DIR__.'/resources/Classes/Controllers' => app_path('Http/Controllers'),
        ], 'core-controllers');

        $this->publishes([
            __DIR__.'/resources/Classes/Requests' => app_path('Http/Requests'),
        ], 'core-requests');

        $this->publishes([
            __DIR__.'/resources/Classes/Models' => app_path(),
        ], 'core-models');
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
        $this->app->register('LaravelEnso\CnpValidator\CnpValidatorServiceProvider');
    }
}
