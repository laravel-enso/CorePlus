<?php

namespace LaravelEnso\CorePlus;

use Illuminate\Support\ServiceProvider;

class CorePlusServiceProvider extends ServiceProvider
{
    private $providers = [
        'Barryvdh\Debugbar\ServiceProvider',
        'LaravelEnso\CommentsManager\CommentsServiceProvider',
                    'LaravelEnso\Contacts\ContactsServiceProvider',
        'LaravelEnso\Core\CoreServiceProvider',
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
