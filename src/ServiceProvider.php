<?php
namespace Car7axo\Laravel\Support;

use \Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    protected $commands = [
        \Car7axo\Laravel\Support\Console\Commands\ControllerMakeCommand::class
    ];

    public function boot()
    {
        $this->loadCommands();
    }

    public function register()
    {

    }

    protected function loadCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->app->extend('command.make.controller', function() {
                return new \Car7axo\Laravel\Support\Console\Commands\ControllerMakeCommand;
            });
            //$this->commands($this->commands);
        }
    }


}
