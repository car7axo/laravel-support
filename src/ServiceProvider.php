<?php

namespace Car7axo\Laravel\Support;

use Illuminate\Support\Collection;
use \Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{

    protected $commands = [
        \Car7axo\Laravel\Support\Console\Commands\DomainMakeCommand::class,
        \Car7axo\Laravel\Support\Console\Commands\UnitMakeCommand::class
    ];

    /**
     * Providers to be registered
     *
     * @var array
     */
    protected $providers = [
        \Car7axo\Laravel\Support\ArtisanServiceProvider::class,
        \Car7axo\Laravel\Support\MigrationServiceProvider::class
    ];


    public function boot()
    {
        //
    }

    public function register()
    {
        $this->registerProviders(collect($this->providers));
        $this->commands($this->commands);
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
