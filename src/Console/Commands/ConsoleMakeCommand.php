<?php
namespace Car7axo\Laravel\Support\Console\Commands;

use Car7axo\Laravel\Support\Console\ConsoleUtils;
use Illuminate\Foundation\Console\ConsoleMakeCommand as LaravelConsoleMakeCommand;
use Symfony\Component\Console\Input\InputArgument;

class ConsoleMakeCommand extends LaravelConsoleMakeCommand
{
    use ConsoleUtils;

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $this->unitNamespace('Console\\Commands');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array_merge([
            ['unit', InputArgument::REQUIRED, 'The name of the unit'],
        ], parent::getArguments());
    }
}
