<?php


namespace Car7axo\Laravel\Support\Console\Commands;

use Car7axo\Laravel\Support\Console\ConsoleUtils;
use Illuminate\Foundation\Console\ModelMakeCommand as LaravelModelMakeCommand;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Support\Str;

class ModelMakeCommand extends LaravelModelMakeCommand
{
    use ConsoleUtils;

    public function getDefaultNamespace($rootNamespace)
    {
        return $this->domainNamespace('Entities');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array_merge([
            ['domain', InputArgument::REQUIRED, 'The domain name'],
        ], parent::getArguments());
    }

    public function createController()
    {
        $unit = $this->ask('Witch unit do want to put your controller?', $this->argument('domain'));

        $controller = Str::studly(class_basename($this->argument('name')));

        $modelName = $this->qualifyClass($this->getNameInput());

        $this->call('make:controller', [
            'unit' => $unit,
            'name' => "{$controller}Controller",
            '--model' => $this->option('resource') ? $modelName : null,
        ]);
    }
}
