<?php

namespace Car7axo\Laravel\Support;

use Illuminate\Support\Collection;
use \Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Providers to be registered
     *
     * @var array
     */
    protected $providers = [
        '\Car7axo\Laravel\Support\ArtisanServiceProvider',
        '\Car7axo\Laravel\Support\MigrationServiceProvider'
    ];


    public function boot()
    {
        //
    }

    public function register()
    {
        $this->registerProviders(collect($this->providers));
    }

    /**
     * Register custom service providers.
     *
     * @param Collection $providers
     */
    protected function registerProviders(Collection $providers)
    {
        // loop through providers to be registered.
        $providers->each(function ($providerClass) {
            // register a provider class.
            $this->app->register($providerClass);
        });
    }
}
