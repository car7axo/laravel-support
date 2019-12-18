<?php

namespace Car7axo\Laravel\Support\Console\Commands;

use Car7axo\Laravel\Support\Console\ConsoleUtils;
use Symfony\Component\Console\Input\InputArgument;

use Illuminate\Foundation\Console\MailMakeCommand as LaravelMailMakeCommand;

class  MailMakeCommand extends LaravelMailMakeCommand
{
    use ConsoleUtils;

    public function getDefaultNamespace($rootNamespace)
    {
        return $this->domainNamespace('Mail');
    }

    protected function getStub()
    {
        return $this->option('markdown')
            ? __DIR__.'/stubs/mail/markdown-mail.stub'
            : __DIR__.'/stubs/mail/mail.stub';
    }

    protected function writeMarkdownTemplate()
    {
        $markdown = $this->option('markdown');
        $filePath = str_replace('.', '/', $markdown).'.blade.php';
        $path = $this->domainPath('Resources/views');
        $path = $path . '/' . $filePath;

        if (! $this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0755, true);
        }

        $this->files->put($path, file_get_contents(__DIR__.'/stubs/mail/markdown.stub'));
    }

    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());
        $domain = mb_strtolower($this->argument('domain'));
        $markdownView = "{$domain}::{$this->option('markdown')}";

        return $this->replaceNamespace($stub, $name)
            ->replaceDomainName($stub, $domain)
            ->replaceMarkdownView($stub, $markdownView)
            ->replaceClass($stub, $name);
    }

    protected function replaceDomainName(&$stub, $name)
    {
        $stub = str_replace(
            ['Dummydomain'],
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
            ['domain', InputArgument::REQUIRED, 'The name of domain'],
        ], parent::getArguments());
    }
}
