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

    /**
     * Create a model factory for the model.
     *
     * @return void
     */
    protected function createFactory()
    {
        $factory = Str::studly(class_basename($this->argument('name')));

        $this->call('make:factory', [
            'domain' => $this->argument('domain'),
            'name' => "{$factory}Factory",
            '--model' => $this->getNameInput(),
        ]);
    }

    /**
     * Create a migration file for the model.
     *
     * @return void
     */
    protected function createMigration()
    {
        $table = Str::snake(Str::pluralStudly(class_basename($this->argument('name'))));

        if ($this->option('pivot')) {
            $table = Str::singular($table);
        }

        $this->call('make:migration', [
            'domain' => $this->argument('domain'),
            'name' => "create_{$table}_table",
            '--create' => $table,
        ]);
    }
}
