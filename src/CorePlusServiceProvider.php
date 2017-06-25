<?php

namespace LaravelEnso\CorePlus;

use Illuminate\Support\ServiceProvider;

class CorePlusServiceProvider extends ServiceProvider
{
    private $providers = [
        'Barryvdh\Debugbar\ServiceProvider',
        'LaravelEnso\CnpValidator\CnpValidatorServiceProvider',
        'LaravelEnso\CommentsManager\CommentsServiceProvider',
        'LaravelEnso\ContactPersons\ContactPersonsServiceProvider',
        'LaravelEnso\Core\CoreServiceProvider',
        'LaravelEnso\DataImport\DataImportServiceProvider',
        'LaravelEnso\DocumentsManager\DocumentsServiceProvider',
        'LaravelEnso\Notifications\NotificationsServiceProvider',
    ];

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    public function register()
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
    }
}
