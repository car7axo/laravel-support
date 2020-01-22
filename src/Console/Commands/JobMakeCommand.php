<?php

namespace Car7axo\Laravel\Support\Console\Commands;

use Car7axo\Laravel\Support\Console\ConsoleUtils;
use Illuminate\Foundation\Console\JobMakeCommand as LaravelJobMakeCommand;
use Symfony\Component\Console\Input\InputArgument;

class JobMakeCommand extends LaravelJobMakeCommand
{
    use ConsoleUtils;
    
    protected function getDefaultNamespace($rootNamespace)
    {
        return $this->domainNamespace('Jobs');
    }

    protected function getStub()
    {
        return $this->option('sync')
            ? __DIR__.'/stubs/job/job.stub'
            : __DIR__.'/stubs/job/job-queued.stub';
    }

    protected function getArguments()
    {
        return array_merge([
            ['domain', InputArgument::REQUIRED, 'Domain name'],
        ], parent::getArguments());
    }
}