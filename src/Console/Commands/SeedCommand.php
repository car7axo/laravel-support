<?php

namespace Car7axo\Laravel\Support\Console\Commands;

use Illuminate\Database\Console\Seeds\SeedCommand as LaravelSeedCommand;
use Car7axo\Laravel\Support\Console\ConsoleUtils;
use Symfony\Component\Console\Input\InputArgument;

class SeedCommand extends LaravelSeedCommand
{
    use ConsoleUtils;

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
    /**
     * Get a seeder instance from the container.
     *
     * @return \Illuminate\Database\Seeder
     */
    protected function getSeeder()
    {
        $class = $this->input->getOption('class') === 'DatabaseSeeder'
            ? 'App\\Domains\\Core\\Database\\Seeds\\DatabaseSeeder'
            : $this->domainNamespace('Database/Seeds') . '\\' .  $this->input->getOption('class');

        $class = $this->laravel->make($class);

        return $class->setContainer($this->laravel)->setCommand($this);
    }
}
