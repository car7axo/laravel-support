<?php
namespace App\Support\Console;

use Illuminate\Support\Str;

trait HasModule
{
    protected function getModuleNamespace($path = null)
    {
        $module = Str::studly($this->argument('module'));
        $moduleNamespace = app()->getNamespace() . 'Modules\\' . $module;

        if ($path) {
            $path = str_replace('/', '\\', $path);
            $moduleNamespace = $moduleNamespace . '\\' . $path;
        }

        return $moduleNamespace;
    }

    protected function getModulePath($path = null)
    {
        $module = Str::studly($this->argument('module'));
        $modulePath = app_path("Modules/{$module}");

        if ($path) {
            $modulePath = "{$modulePath}/{$path}";
        }

        return $modulePath;
    }
}
