<?php

namespace Car7axo\Laravel\Support;

use Car7axo\Laravel\Support\Console\Commands\ConsoleMakeCommand;
use Car7axo\Laravel\Support\Console\Commands\ControllerMakeCommand;
use Car7axo\Laravel\Support\Console\Commands\FactoryMakeCommand;
use Car7axo\Laravel\Support\Console\Commands\ModelMakeCommand;
use Car7axo\Laravel\Support\Console\Commands\SeedCommand;
use Car7axo\Laravel\Support\Console\Commands\SeederMakeCommand;
use Illuminate\Console\Scheduling\ScheduleFinishCommand;
use Illuminate\Console\Scheduling\ScheduleRunCommand;
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

    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $commands = [
        'CacheClear' => 'command.cache.clear',
        'CacheForget' => 'command.cache.forget',
        'ClearCompiled' => 'command.clear-compiled',
        'ClearResets' => 'command.auth.resets.clear',
        'ConfigCache' => 'command.config.cache',
        'ConfigClear' => 'command.config.clear',
        'DbWipe' => 'command.db.wipe',
        'Down' => 'command.down',
        'Environment' => 'command.environment',
        'EventCache' => 'command.event.cache',
        'EventClear' => 'command.event.clear',
        'EventList' => 'command.event.list',
        'KeyGenerate' => 'command.key.generate',
        'Optimize' => 'command.optimize',
        'OptimizeClear' => 'command.optimize.clear',
        'PackageDiscover' => 'command.package.discover',
        'Preset' => 'command.preset',
        'QueueFailed' => 'command.queue.failed',
        'QueueFlush' => 'command.queue.flush',
        'QueueForget' => 'command.queue.forget',
        'QueueListen' => 'command.queue.listen',
        'QueueRestart' => 'command.queue.restart',
        'QueueRetry' => 'command.queue.retry',
        'QueueWork' => 'command.queue.work',
        'RouteCache' => 'command.route.cache',
        'RouteClear' => 'command.route.clear',
        'RouteList' => 'command.route.list',
        'Seed' => SeedCommand::class,
        'ScheduleFinish' => ScheduleFinishCommand::class,
        'ScheduleRun' => ScheduleRunCommand::class,
        'StorageLink' => 'command.storage.link',
        'Up' => 'command.up',
        'ViewCache' => 'command.view.cache',
        'ViewClear' => 'command.view.clear',
    ];
}
