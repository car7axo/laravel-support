<?php
namespace Car7axo\Laravel\Support\Console\Commands;

use Car7axo\Laravel\Support\Console\ConsoleUtils;
use Illuminate\Foundation\Console\ComponentMakeCommand as LaravelComponentMakeCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

class ComponentMakeCommand extends LaravelComponentMakeCommand {
    use ConsoleUtils;

    protected function getDefaultNamespace($rootNamespace)
    {
        return $this->unitNamespace('View\Components');
    }

    /**
     * Write the view for the component.
     *
     * @return void
     */
    protected function writeView()
    {
        $view = $this->getView();

        $path = $this->unitPath('Resources/views').'/'.str_replace('.', '/', 'components.'.$view);

        if (! $this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }

        file_put_contents(
            $path.'.blade.php',
            '<div>
    <!-- '.Inspiring::quote().' -->
</div>'
        );
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        if ($this->option('inline')) {
            return str_replace(
                'DummyView',
                "<<<'blade'\n<div>\n    ".Inspiring::quote()."\n</div>\nblade",
                $this->build($name)
            );
        }

        $unit = Str::lower($this->argument('unit'));

        return str_replace(
            'DummyView',
            'view(\''.$unit.'::components.'.$this->getView().'\')',
            $this->build($name)
        );
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function build($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }

    protected function getArguments()
    {
        return array_merge([
           ['unit', InputArgument::REQUIRED, 'Unit name'],
       ], parent::getArguments());
    }
}
