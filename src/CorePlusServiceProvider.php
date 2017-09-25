<?php

namespace LaravelEnso\CorePlus;

use Illuminate\Support\ServiceProvider;

class CorePlusServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    public function register()
    {
        //
    }
}
