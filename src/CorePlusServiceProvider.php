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

        $loader = AliasLoader::getInstance();
        $loader->alias('Date', 'Jenssegers\Date\Date');
    }
}
