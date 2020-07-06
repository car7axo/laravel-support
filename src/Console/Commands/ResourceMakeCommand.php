<?php
namespace Car7axo\Laravel\Support\Console\Commands;

use Car7axo\Laravel\Support\Console\ConsoleUtils;
use Illuminate\Foundation\Console\ResourceMakeCommand as LaravelResourceMakeCommand;
use Symfony\Component\Console\Input\InputArgument;

class ResourceMakeCommand extends LaravelResourceMakeCommand {
    use ConsoleUtils;

    protected function getDefaultNamespace($rootNamespace)
    {
        return $this->unitNamespace('Http\Resources');
    }

    protected function getArguments()
    {
        return array_merge([
           ['unit', InputArgument::REQUIRED, 'Unit name'],
       ], parent::getArguments());
    }
}
