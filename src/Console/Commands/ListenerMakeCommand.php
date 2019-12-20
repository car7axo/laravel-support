<?php

namespace Car7axo\Laravel\Support\Console\Commands;

use Car7axo\Laravel\Support\Console\ConsoleUtils;
use Illuminate\Foundation\Console\ListenerMakeCommand as LaravelListenerMakeCommand;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Filesystem\Filesystem;

class ListenerMakeCommand extends LaravelListenerMakeCommand
{
    use ConsoleUtils;
    
    protected function getDefaultNamespace($rootNamespace)
    {
        return $this->domainNamespace('Listeners');
    }

    protected function getArguments()
    {
        return array_merge([
            ['domain', InputArgument::REQUIRED, 'Domain name'],
        ], parent::getArguments());
    }

    protected function buildClass($name)
    {
        $event = $this->option('event');

        if (! Str::startsWith($event, [
            $this->domainNamespace(),
            'Illuminate',
            '\\',
        ])) {
            $event =$this->domainNamespace().'\\Events\\'.$event;
        }

        $stub = str_replace(
            'DummyEvent', class_basename($event), $this->buildClassByListener($name)
        );
        
        return str_replace(
            'DummyFullEvent', trim($event, '\\'), $stub
        );
    }

    protected function buildClassByListener($name)
    {
        $files = new Filesystem();

        $stub = $files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);

    }

    protected function getStub()
    {
        if ($this->option('queued')) {
            return $this->option('event')
                ? __DIR__.'/stubs/listener/listener-queued.stub'
                : __DIR__.'/stubs/listener/listener-queued-duck.stub';
        }

        return $this->option('event')
            ? __DIR__.'/stubs/listener/listener.stub'
            : __DIR__.'/stubs/listener/listener-duck.stub';
    }

    protected function getOptions()
    {
        return [
            ['event', 'e', InputOption::VALUE_OPTIONAL, 'The event class being listened for'],

            ['queued', null, InputOption::VALUE_NONE, 'Indicates the event listener should be queued'],
        ];
    }
}