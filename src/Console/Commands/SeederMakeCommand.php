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
        return $this->domainPath("Database/Seeds/{$name}.php");
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        $stub = str_replace(
            ['DummyNamespace', 'DummyRootNamespace', 'NamespacedDummyUserModel'],
            [$this->domainNamespace('Database/Seeds'), $this->rootNamespace(), $this->userProviderModel()],
            $stub
        );

        return $this;
    }
}
