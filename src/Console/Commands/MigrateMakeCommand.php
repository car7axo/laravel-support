<?php

namespace Car7axo\Laravel\Support\Console\Commands;


use Car7axo\Laravel\Support\Console\ConsoleUtils;
use Illuminate\Database\Console\Migrations\MigrateMakeCommand as LaravelMigrateMakeCommand;
use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\File;

class MigrateMakeCommand extends LaravelMigrateMakeCommand
{
    use ConsoleUtils;

    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'make:migration 
        {domain : The domain name}
        {name : The name of the migration}
        {--create= : The table to be created}
        {--table= : The table to migrate}
        {--path= : The location where the migration file should be created}
        {--realpath : Indicate any provided migration file paths are pre-resolved absolute paths}
        {--fullpath : Output the full path of the migration}';

    public function __construct(Composer $composer)
    {
        parent::__construct(
            new MigrationCreator(
                app('Illuminate\Filesystem\Filesystem'),
                null
            ),
            $composer
        );
    }

    /**
     * Get migration path (either specified by '--path' option or default location).
     *
     * @return string
     */
    protected function getMigrationPath()
    {

        $path = $this->domainPath('Database/Migrations');

        if (!is_null($targetPath = $this->input->getOption('path'))) {
            $path = !$this->usingRealPath()
                ? $this->laravel->basePath() . '/' . $targetPath
                : $targetPath;
        }

        if (!is_dir($path)) {
            File::makeDirectory($path, 0755, true);
        }

        return $path;
    }
}
