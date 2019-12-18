<?php

namespace Car7axo\Laravel\Support\Console\Commands;

use Car7axo\Laravel\Support\Console\ConsoleUtils;
use Illuminate\Database\Console\Seeds\SeederMakeCommand as LaravelSeederMakeCommand;
use Symfony\Component\Console\Input\InputArgument;

class SeederMakeCommand extends LaravelSeederMakeCommand
{
    use ConsoleUtils;

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array_merge([
            ['domain', InputArgument::REQUIRED, 'The domain name'],
        ], parent::getArguments());
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/seeders/seeder.stub';
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        return $this->domainPath("Database/Seeders/{$name}.php");
    }
}
