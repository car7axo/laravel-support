<?php
namespace App\Modules\Core\Console\Commands;

use Car7axo\Laravel\Support\Console\ConsoleUtils;
use Symfony\Component\Console\Input\InputArgument;

use Illuminate\Foundation\Console\MailMakeCommand as LaravelMailMakeCommand;

class  MailMakeCommand extends LaravelMailMakeCommand
{
    use ConsoleUtils;

    public function getDefaultNamespace($rootNamespace)
    {
        return $this->unitNamespace('Mail');
    }

    protected function getStub()
    {
        return $this->option('markdown')
            ? __DIR__.'/stubs/markdown-mail.stub'
            : __DIR__.'/stubs/mail.stub';
    }

    protected function writeMarkdownTemplate()
    {
        $markdown = $this->option('markdown');
        $filePath = str_replace('.', '/', $markdown).'.blade.php';
        $path = $this->unitPath('Resources/views');
        $path = $path . '/' . $filePath;

        if (! $this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0755, true);
        }

        $this->files->put($path, file_get_contents(__DIR__.'/stubs/markdown.stub'));
    }

    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());
        $unit = mb_strtolower($this->argument('module'));
        $markdownView = "{$unit}::{$this->option('markdown')}";

        return $this->replaceNamespace($stub, $name)
            ->replaceUnitName($stub, $unit)
            ->replaceMarkdownView($stub, $markdownView)
            ->replaceClass($stub, $name);
    }

    protected function replaceUnitName(&$stub, $name)
    {
        $stub = str_replace(
            ['DummyUnit'],
            [$name],
            $stub
        );
        return $this;
    }

    protected function replaceMarkdownView(&$stub, $name)
    {
        $stub = str_replace(
            ['DummyView'],
            [$name],
            $stub
        );
        return $this;
    }

    public function getArguments()
    {
        return array_merge([
            ['unit', InputArgument::REQUIRED, 'The name of unit'],
        ], parent::getArguments());
    }
}
