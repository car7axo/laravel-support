<?php
namespace Car7axo\Laravel\Support;

use Car7axo\Laravel\Support\Console\Commands\ChannelMakeCommand;
use Car7axo\Laravel\Support\Console\Commands\ConsoleMakeCommand;
use Car7axo\Laravel\Support\Console\Commands\ControllerMakeCommand;
use Car7axo\Laravel\Support\Console\Commands\MailMakeCommand;
use Car7axo\Laravel\Support\Console\Commands\ObserverMakeCommand;
use Car7axo\Laravel\Support\Console\Commands\RequestMakeCommand;
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
        'ObserverMake' => ObserverMakeCommand::class,
        'MailMake' => MailMakeCommand::class,
        'RequestMake' => RequestMakeCommand::class,
        'ChannelMake' => ChannelMakeCommand::class,
    ];
}
