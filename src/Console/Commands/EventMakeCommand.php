<?php

namespace Car7axo\Laravel\Support\Console\Commands;

use Car7axo\Laravel\Support\Console\ConsoleUtils;
use Illuminate\Foundation\Console\EventMakeCommand as LaravelEventMakeCommand;
use Symfony\Component\Console\Input\InputArgument;

class EventMakeCommand extends LaravelEventMakeCommand
{
    use ConsoleUtils;

    protected function getDefaultNamespace($rootNamespace)
    {
        return $this->domainNamespace('Events');
    }

    protected function getArguments()
    {
        return array_merge([
           ['domain', InputArgument::REQUIRED, 'Domain name'],
       ], parent::getArguments());
    }
}
