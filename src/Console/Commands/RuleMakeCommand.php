<?php

namespace Car7axo\Laravel\Support\Console\Commands;

use Car7axo\Laravel\Support\Console\ConsoleUtils;
use Illuminate\Foundation\Console\RuleMakeCommand as LaravelRuleMakeCommand;
use Symfony\Component\Console\Input\InputArgument;

class RuleMakeCommand extends LaravelRuleMakeCommand
{
    use ConsoleUtils;
    
    protected function getDefaultNamespace($rootNamespace)
    {
        return $this->domainNamespace('Rules');
    }

    protected function getArguments()
    {
        return array_merge([
            ['domain', InputArgument::REQUIRED, 'Domain name'],
        ], parent::getArguments());
    }
}