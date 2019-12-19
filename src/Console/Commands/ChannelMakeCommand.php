<?php
namespace Car7axo\Laravel\Support\Console\Commands;

use Car7axo\Laravel\Support\Console\ConsoleUtils;
use Illuminate\Foundation\Console\ChannelMakeCommand as LaravelChannelMakeCommand;
use Symfony\Component\Console\Input\InputArgument;

class ChannelMakeCommand extends LaravelChannelMakeCommand
{
    use ConsoleUtils;

    public function getDefaultNamespace($rootNamespace)
    {
        return $this->unitNamespace('Broadcasting');
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
}
