<?php

namespace Car7axo\Laravel\Support\Console\Commands;

use Car7axo\Laravel\Support\Console\ConsoleUtils;
use Illuminate\Console\Command;

class DomainMakeCommand extends Command
{
    use ConsoleUtils;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:domain {name : The domain name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Domain';

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
            '--domain' => $this->input->getArgument('name'),
            'name' => $this->input->getArgument('name'),
            '--type' => 'domains'
        ]);
    }
}
