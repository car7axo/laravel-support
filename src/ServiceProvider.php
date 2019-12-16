<?php
namespace Car7axo\Laravel\Support;

use \Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    public function boot()
    {
        $this->publishConfig();
    }

    public function register()
    {

    }

    protected function publishConfig()
    {
        $this->publishes([
            __DIR__ . '../config/domains.php',
            __DIR__ . '../config/units.php',
        ], 'config');
    }
}
