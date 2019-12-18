<?php

namespace Car7axo\Laravel\Support\Console\Commands;

use Car7axo\Laravel\Support\Console\ConsoleUtils;
use Illuminate\Routing\Console\ControllerMakeCommand as LaravelControllerMakeCommand;
use Symfony\Component\Console\Input\InputArgument;

class ControllerMakeCommand extends LaravelControllerMakeCommand
{
    use ConsoleUtils;

    public function getDefaultNamespace($rootNamespace)
    {
        return $this->unitNamespace('Http\\Controllers');
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

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $stub = null;

        if ($this->option('parent')) {
            $stub = '/stubs/controllers/controller.nested.stub';
        } elseif ($this->option('model')) {
            $stub = '/stubs/controllers/controller.model.stub';
        } elseif ($this->option('invokable')) {
            $stub = '/stubs/controllers/controller.invokable.stub';
        } elseif ($this->option('resource')) {
            $stub = '/stubs/controllers/controller.stub';
        }

        if ($this->option('api') && is_null($stub)) {
            $stub = '/stubs/controllers/controller.api.stub';
        } elseif ($this->option('api') && !is_null($stub) && !$this->option('invokable')) {
            $stub = str_replace('.stub', '.api.stub', $stub);
        }

        $stub = $stub ?? '/stubs/controllers/controller.plain.stub';

        return __DIR__ . $stub;
    }
}
