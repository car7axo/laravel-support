<?php

namespace Car7axo\Laravel\Support;

use \Illuminate\Foundation\Providers\ArtisanServiceProvider as LaravelArtisanServiceProvider;

/**
 * Class ArtisanServiceProvider
 * @package Car7axo\Laravel\Support
 */
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
        'VendorPublish' => 'command.vendor.publish',
        'TestMake' => 'command.test.make',
        'ControllerMake' => \Car7axo\Laravel\Support\Console\Commands\ControllerMakeCommand::class,
        'ConsoleMake' => \Car7axo\Laravel\Support\Console\Commands\ConsoleMakeCommand::class,
        'ObserverMake' => \Car7axo\Laravel\Support\Console\Commands\ObserverMakeCommand::class,
        'MailMake' => \Car7axo\Laravel\Support\Console\Commands\MailMakeCommand::class,
        'RequestMake' => \Car7axo\Laravel\Support\Console\Commands\RequestMakeCommand::class,
        'ChannelMake' => \Car7axo\Laravel\Support\Console\Commands\ChannelMakeCommand::class,
        'NotificationMake' => \Car7axo\Laravel\Support\Console\Commands\NotificationMakeCommand::class,
        'RuleMake' => \Car7axo\Laravel\Support\Console\Commands\RuleMakeCommand::class,
        'PolicyMake' => \Car7axo\Laravel\Support\Console\Commands\PolicyMakeCommand::class,
        'ProviderMake' => \Car7axo\Laravel\Support\Console\Commands\ProviderMakeCommand::class,
        'EventMake' => \Car7axo\Laravel\Support\Console\Commands\EventMakeCommand::class,
        'JobMake' => \Car7axo\Laravel\Support\Console\Commands\JobMakeCommand::class,
        'ExceptionMake' => \Car7axo\Laravel\Support\Console\Commands\ExceptionMakeCommand::class,
        'ListenerMake' => \Car7axo\Laravel\Support\Console\Commands\ListenerMakeCommand::class,
        'MiddlewareMake' => \Car7axo\Laravel\Support\Console\Commands\MiddlewareMakeCommand::class,
        'ModelMake' => \Car7axo\Laravel\Support\Console\Commands\ModelMakeCommand::class,
        'FactoryMake' => \Car7axo\Laravel\Support\Console\Commands\FactoryMakeCommand::class,
        'SeederMake' =>  Car7axo\Laravel\Support\Console\Commands\SeederMakeCommand::class,
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
        'Seed' =>  \Car7axo\Laravel\Support\Console\Commands\SeedCommand::class,
        'ScheduleFinish' => \Illuminate\Console\Scheduling\ScheduleFinishCommand::class,
        'ScheduleRun' => \Illuminate\Console\Scheduling\ScheduleRunCommand::class,
        'StorageLink' => 'command.storage.link',
        'Up' => 'command.up',
        'ViewCache' => 'command.view.cache',
        'ViewClear' => 'command.view.clear',
    ];
}
