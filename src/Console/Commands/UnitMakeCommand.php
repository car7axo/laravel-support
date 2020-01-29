<?php

namespace Car7axo\Laravel\Support\Console\Commands;

use Car7axo\Laravel\Support\Console\ConsoleUtils;
use Illuminate\Console\Command;

class UnitMakeCommand extends Command
{
    use ConsoleUtils;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:unit {name : The unit name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Unit';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('make:provider', [
            '--unit' => $this->input->getArgument('name'),
            'name' => $this->input->getArgument('name'),
            '--layer' => 'Units',
            '--type' => 'units'
        ]);

        $this->call('make:provider', [
            '--unit' => $this->input->getArgument('name'),
            'name' => $this->input->getArgument('name'),
            '--layer' => 'Units',
            '--type' => 'unitRoute',
            '--quiet' => '-q'
        ]);

        $this->call('make:provider', [
            '--unit' => $this->input->getArgument('name'),
            'name' => $this->input->getArgument('name'),
            '--layer' => 'Units',
            '--type' => 'web',
            '--quiet' => '-q'
        ]);

        $this->call('make:provider', [
            '--unit' => $this->input->getArgument('name'),
            'name' => $this->input->getArgument('name'),
            '--layer' => 'Units',
            '--type' => 'api',
            '--quiet' => '-q'
        ]);
    }
}
