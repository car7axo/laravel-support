<?php

namespace Car7axo\Laravel\Support;

use Illuminate\Database\MigrationServiceProvider as LaravelMigrationServiceProvider;

class MigrationServiceProvider extends LaravelMigrationServiceProvider
{
    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $commands = [
        'Migrate' => 'command.migrate',
        'MigrateFresh' => 'command.migrate.fresh',
        'MigrateInstall' => 'command.migrate.install',
        'MigrateRefresh' => 'command.migrate.refresh',
        'MigrateReset' => 'command.migrate.reset',
        'MigrateRollback' => 'command.migrate.rollback',
        'MigrateStatus' => 'command.migrate.status',
        'MigrateMake' => \Car7axo\Laravel\Support\Console\Commands\MigrateMakeCommand::class,
    ];
}
