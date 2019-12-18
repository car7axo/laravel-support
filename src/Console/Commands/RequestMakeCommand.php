<?php
namespace Car7axo\Laravel\Support\Console\Commands;

use Car7axo\Laravel\Support\Console\ConsoleUtils;
use Illuminate\Foundation\Console\RequestMakeCommand as LaravelRequestMakeCommand;
use Symfony\Component\Console\Input\InputArgument;

class RequestMakeCommand extends LaravelRequestMakeCommand
{
    use ConsoleUtils;

    public function getDefaultNamespace($rootNamespace)
    {
        return $this->unitNamespace('Http\\Requests');
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
