<?php

namespace LaravelEnso\CorePlus;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class CorePlusServiceProvider extends ServiceProvider
{
    private $providers = [
        'Barryvdh\Debugbar\ServiceProvider',
        'Jenssegers\Date\DateServiceProvider',
        'Maatwebsite\Excel\ExcelServiceProvider',
        'LaravelEnso\CnpValidator\CnpValidatorServiceProvider',
        'LaravelEnso\CommentsManager\CommentsServiceProvider',
        'LaravelEnso\Core\CoreServiceProvider',
        'LaravelEnso\DocumentsManager\DocumentsManagerServiceProvider',
        'LaravelEnso\StatisticsManager\StatisticsManagerServiceProvider'
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

        $this->publishes([
            __DIR__.'/resources/assets/main-js' => resource_path('assets/js'),
        ], 'update');
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

    public function register()
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }

        $loader = AliasLoader::getInstance();
        $loader->alias('Date', 'Jenssegers\Date\Date');
    }
}
