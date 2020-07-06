<?php

namespace Car7axo\Laravel\Support\Console\Commands;

use Car7axo\Laravel\Support\Console\ConsoleUtils;
use Illuminate\Foundation\Console\ProviderMakeCommand as LaravelProviderMakeCommand;
use Symfony\Component\Console\Input\InputOption;

class ProviderMakeCommand extends LaravelProviderMakeCommand
{
    use ConsoleUtils;

    protected $layerName;
    protected $directory;

    /**
     * Execute the console command.
     *
     * @return bool|null
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $name = $this->getNameInput();
        $layer = '';

        switch ($this->option('type')) {
            case 'domains':
                $name = 'DomainServiceProvider';
                $this->layerName = 'Domains';
                $layer = "app/{$this->layerName}/{$this->option('domain')}/Providers";

                break;

            case 'units':
                $name = 'UnitServiceProvider';
                $this->layerName = 'Units';
                $layer = "app/{$this->layerName}/{$this->option('unit')}/Providers";

                break;

            case 'unitRoute':
                $name = 'RouteServiceProvider';
                $this->layerName = 'Units';
                $layer = "app/{$this->layerName}/{$this->option('unit')}/Providers";

                break;

            case 'route':
                $name = 'RouteServiceProvider';
                $this->layerName = 'Units';
                $this->directory = $this->option('unit') ? $this->option('unit')  : $this->ask("Witch {$this->layerName} do want to put your provider");
                $layer = "app/{$this->layerName}/{$this->directory}/Providers";

                break;

            case 'web':
                $name = 'web';
                $this->layerName = 'Units';
                $layer = "app/{$this->layerName}/{$this->option('unit')}/Routes";

                break;

            case 'api':
                $name = 'api';
                $this->layerName = 'Units';
                $layer = "app/{$this->layerName}/{$this->option('unit')}/Routes";

                break;

            default:
                if ($this->option('unit')) {
                    $this->layerName = 'Units';
                    $this->directory = $this->option('unit');
                } elseif ($this->option('domain')) {
                    $this->layerName = 'Domains';
                    $this->directory = $this->option('domain');
                } else {
                    $this->layerName = $this->choice('Witch layer do want to put your provider, Domains or Units?', ['Domains', 'Units']);
                    $this->directory = $this->ask("Witch {$this->layerName} do want to put your provider");
                }

                $layer = "app/{$this->layerName}/{$this->directory}/Providers";

                break;
        }

        $path = $layer . '/' . str_replace('\\', '/', $name) . '.php';
        // First we will check to see if the class already exists. If it does, we don't want
        // to create the class and overwrite the user's code. So, we will bail out so the
        // code is untouched. Otherwise, we will continue generating this class' files.
        if ((!$this->hasOption('force') ||
                !$this->option('force')) &&
            $this->alreadyExists($this->getNameInput())
        ) {
            $this->error($this->type . ' already exists!');

            return false;
        }

        // Next, we will generate the path to the location where this class' file should get
        // written. Then, we will build the class and make the proper replacements on the
        // stub files so that it gets the correctly formatted namespace and class name.
        $this->makeDirectory($path);
        $this->files->put($path, $this->sortImports($this->buildClass($name)));

        if (!$this->option('quiet')) {
            $this->info($this->type . ' created successfully.');
        }
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['unit', 'u', InputOption::VALUE_OPTIONAL, 'Generate a Unit Provider'],
            ['domain', 'd', InputOption::VALUE_OPTIONAL, 'Generate a Domain Provider'],
            ['type', 't', InputOption::VALUE_OPTIONAL, 'Defination Type Provider']
        ];
    }



    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $type = $this->hasOption('type') ? $this->option('type') : null;

        $stub = '/stubs/providers/default-provider.stub';

        if ($type === 'units') {
            $stub = '/stubs/providers/units-provider.stub';
        }

        if ($type === 'domains') {
            $stub = '/stubs/providers/domains-provider.stub';
        }

        if ($type === 'route' || $type === 'unitRoute') {
            $stub = '/stubs/providers/routes-provider.stub';
        }

        if ($type === 'web') {
            $stub = '/stubs/routes/routes-web.stub';
        }

        if ($type === 'api') {
            $stub = '/stubs/routes/routes-api.stub';
        }

        return __DIR__ . $stub;
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        $namespace = $this->layerName;
        $directory = $this->directory;

        if ($directory === null) {
            $directory = $this->getNameInput();
        }

        $stub = str_replace(
            [
                'DummyNamespace',
                'DummyRootNamespace',
                'NamespacedDummyUserModel',
                'DummyControllerNamespace',
                'DummyAlias'
            ],
            [
                $this->domainNamespace($namespace . '\\' . $directory, 'Providers'),
                $this->rootNamespace(),
                $this->userProviderModel(),
                $this->domainNamespace($namespace . '\\' . $directory, 'Http\Controllers'),
                strtolower($directory)
            ],
            $stub
        );

        return $this;
    }

    /**
     * Generate domain namespace
     *
     * @param string $namespace
     * @param string $directory
     * @param string|null $path
     * @return string
     */
    protected function domainNamespace(string $namespace, string $directory, string $path = null): string
    {
        return $this->generateLayerNamespace(
            $namespace,
            $directory,
            $path
        );
    }
}
