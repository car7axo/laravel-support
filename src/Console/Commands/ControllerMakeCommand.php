<?php
namespace Car7axo\Laravel\Support\Console\Commands;

use Car7axo\Laravel\Support\Console\ConsoleUtils;
use Illuminate\Routing\Console\ControllerMakeCommand as LaravelControllerMakeCommand;
use Symfony\Component\Console\Input\InputArgument;

class ControllerMakeCommand extends LaravelControllerMakeCommand
{
    use ConsoleUtils;

    protected $name = 'make:controller';

    public function getDefaultNamespace($rootNamespace)
    {
        return $this->unitNamespace('Http\\Controllers');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array_merge([
            ['unit', InputArgument::REQUIRED, 'Unit name'],
        ], parent::getArguments());
    }
}
