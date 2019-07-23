<?php
namespace Car7axo\Laravel\Support\Console;

use Illuminate\Support\Str;

trait HasDomain
{
    protected function getDomainNamespace($path = null)
    {
        $domain = Str::studly($this->argument('domain'));
        $domainNamespace = app()->getNamespace() . 'Domains\\' . $domain;

        if ($path) {
            $path = str_replace('/', '\\', $path);
            $domainNamespace = $domainNamespace . '\\' . $path;
        }

        return $domainNamespace;
    }

    protected function getDomainPath($path = null)
    {
        $domain = Str::studly($this->argument('domain'));
        $domainPath = app_path("Domains/{$domain}");

        if ($path) {
            $domainPath = "{$domainPath}/{$path}";
        }

        return $domainPath;
    }
}
