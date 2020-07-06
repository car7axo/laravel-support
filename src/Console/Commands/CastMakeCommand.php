<?php
namespace Car7axo\Laravel\Support\Console\Commands;
use Car7axo\Laravel\Support\Console\ConsoleUtils;
use Illuminate\Foundation\Console\CastMakeCommand as LaravelCastMakeCommand;
use Symfony\Component\Console\Input\InputArgument;

class CastMakeCommand extends LaravelCastMakeCommand{
    use ConsoleUtils;

    protected function getDefaultNamespace($rootNamespace)
    {
        return $this->domainNamespace('Casts');
    }

    protected function getArguments()
    {
        return array_merge([
           ['domain', InputArgument::REQUIRED, 'Domain name'],
       ], parent::getArguments());
    }
}
