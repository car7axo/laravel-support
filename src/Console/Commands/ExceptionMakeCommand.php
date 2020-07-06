<?php

namespace Car7axo\Laravel\Support\Console\Commands;

use Car7axo\Laravel\Support\Console\ConsoleUtils;
use Illuminate\Foundation\Console\ExceptionMakeCommand as LaravelExceptionMakeCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ExceptionMakeCommand extends LaravelExceptionMakeCommand
{
    use ConsoleUtils;
    
    protected function getDefaultNamespace($rootNamespace)
    {
        return $this->domainNamespace('Exceptions');
    }

    protected function getStub()
    {
        if ($this->option('render')) {
            return $this->option('report')
                ? __DIR__.'/stubs/exception/exception-render-report.stub'
                : __DIR__.'/stubs/exception/exception-render.stub';
        }

        return $this->option('report')
            ? __DIR__.'/stubs/exception/exception-report.stub'
            : __DIR__.'/stubs/exception/exception.stub';
    }

    protected function getOptions()
    {
        return [
            ['render', null, InputOption::VALUE_NONE, 'Create the exception with an empty render method'],

            ['report', null, InputOption::VALUE_NONE, 'Create the exception with an empty report method'],
        ];
    }

    protected function getArguments()
    {
        return array_merge([
            ['domain', InputArgument::REQUIRED, 'Domain name'],
        ], parent::getArguments());
    }
}