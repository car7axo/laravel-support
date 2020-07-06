<?php

namespace Car7axo\Laravel\Support\Console\Commands;

use Car7axo\Laravel\Support\Console\ConsoleUtils;
use Illuminate\Foundation\Console\NotificationMakeCommand as LaravelNotificationMakeCommand;
use Symfony\Component\Console\Input\InputArgument;

class NotificationMakeCommand extends LaravelNotificationMakeCommand
{
    use ConsoleUtils;
    
    protected function getDefaultNamespace($rootNamespace)
    {
        return $this->domainNamespace('Notifications');
    }

    protected function getStub()
    {
        return $this->option('markdown')
            ? __DIR__.'/stubs/notification/markdown-notification.stub'
            : __DIR__.'/stubs/notification/notification.stub';
    }

    protected function replaceDomainName(&$stub, $name)
    {
        $stub = str_replace(
            ['Dummydomain'],
            [$name],
            $stub
        );
        return $this;
    }

    protected function replaceMarkdownView(&$stub, $name)
    {
        $stub = str_replace(
            ['DummyView'],
            [$name],
            $stub
        );
        return $this;
    }

    protected function getArguments()
    {
        return array_merge([
            ['domain', InputArgument::REQUIRED, 'Domain name'],
        ], parent::getArguments());
    }
}