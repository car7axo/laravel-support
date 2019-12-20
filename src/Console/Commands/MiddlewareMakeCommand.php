<?php
namespace Car7axo\Laravel\Support\Console\Commands;

use Car7axo\Laravel\Support\Console\ConsoleUtils;
use Illuminate\Routing\Console\MiddlewareMakeCommand as LaravelMiddlewareMakeCommand;
use Symfony\Component\Console\Input\InputArgument;

class MiddlewareMakeCommand extends LaravelMiddlewareMakeCommand
{
    use ConsoleUtils;

    public function getDefaultNamespace($rootNamespace)
    {
        return $this->unitNamespace('Http\\Middleware');
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
