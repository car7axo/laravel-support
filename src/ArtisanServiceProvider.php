<?php

namespace Car7axo\Laravel\Support;

use Car7axo\Laravel\Support\Console\Commands\ConsoleMakeCommand;
use Car7axo\Laravel\Support\Console\Commands\ControllerMakeCommand;
use Car7axo\Laravel\Support\Console\Commands\FactoryMakeCommand;
use Car7axo\Laravel\Support\Console\Commands\MigrateMakeCommand;
use Car7axo\Laravel\Support\Console\Commands\ModelMakeCommand;
use Car7axo\Laravel\Support\Console\Commands\SeederMakeCommand;
use \Illuminate\Foundation\Providers\ArtisanServiceProvider as LaravelArtisanServiceProvider;

class ArtisanServiceProvider extends LaravelArtisanServiceProvider
{
    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $devCommands = [
        'CacheTable' => 'command.cache.table',
        'NotificationTable' => 'command.notification.table',
        'QueueFailedTable' => 'command.queue.failed-table',
        'QueueTable' => 'command.queue.table',
        'SessionTable' => 'command.session.table',
        'Serve' => 'command.serve',
        'TestMake' => 'command.test.make',
        'VendorPublish' => 'command.vendor.publish',
        'ControllerMake' => ControllerMakeCommand::class,
        'ConsoleMake' => ConsoleMakeCommand::class,
        'ModelMake' => ModelMakeCommand::class,
        'FactoryMake' => FactoryMakeCommand::class,
        'SeederMake' => SeederMakeCommand::class,
    ];
}
