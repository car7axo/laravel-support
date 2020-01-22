<?php

namespace Car7axo\Laravel\Support\Console\Commands;

use Car7axo\Laravel\Support\Console\ConsoleUtils;
use Illuminate\Foundation\Console\PolicyMakeCommand as LaravelPolicyMakeCommand;
use Symfony\Component\Console\Input\InputArgument;

class PolicyMakeCommand extends LaravelPolicyMakeCommand
{
    use ConsoleUtils;
    
    protected function getDefaultNamespace($rootNamespace)
    {
        return $this->domainNamespace('Policies');
    }

    protected function getArguments()
    {
        return array_merge([
            ['domain', InputArgument::REQUIRED, 'Domain name'],
        ], parent::getArguments());
    }
}