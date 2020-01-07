<?php

namespace Car7axo\Laravel\Support\Console\Commands;

use Car7axo\Laravel\Support\Console\ConsoleUtils;
use Illuminate\Foundation\Console\TestMakeCommand as LaravelTestMakeCommand;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

class TestMakeCommand extends LaravelTestMakeCommand
{
    use ConsoleUtils;

    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'make:test 
        {domain : The domain name}
        {name : The name of the test}
        {--unit : Create a unit test}';

    protected function getPath($name)
    {
        return $this->domainPath() . '/' . str_replace('\\', '/', $name).'.php';
    }

    protected function getArguments()
    {
        return array_merge([
            ['domain', InputArgument::REQUIRED, 'Domain name'],
        ], parent::getArguments());
    }

    protected function getStub()
    {
        if ($this->option('unit')) {
            return __DIR__.'/stubs/tests/unit-test.stub';
        }

        return __DIR__.'/stubs/tests/test.stub';
    }
}
