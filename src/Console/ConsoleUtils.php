<?php
namespace Car7axo\Laravel\Support\Console;

use Illuminate\Support\Str;

/**
 * Trait ConsoleUtils
 * @package Car7axo\Laravel\Support\Console
 */
trait ConsoleUtils
{
    /**
     * Generate layer (domain, unit) namespace
     *
     * @param string $namespace
     * @param string $layer
     * @param string|null $path
     * @return string
     */
    protected function generateLayerNamespace(string $namespace, string $layer, string $path = null) : string
    {
        $layerName = Str::ucfirst($namespace);
        $layer = Str::studly($layer);
        $layerNamespace = app()->getNamespace() . $layerName . "\\" . $layer;

        if ($path) {
            $path = str_replace('/', '\\', $path);
            $layerNamespace = $layerNamespace . '\\' . $path;
        }

        return $layerNamespace;
    }

    /**
     * Generate layer (domain, unit) base path
     *
     * @param string $namespace
     * @param string $layer
     * @param string|null $path
     * @return string
     */
    protected function generateLayerPath(string $namespace, string $layer, string $path = null) : string
    {
        $layerName = Str::ucfirst($namespace);
        $layer = Str::studly($layer);
        $layerPath = app_path("{$layerName}/{$layer}");

        if ($path) {
            $layerPath = "{$layerPath}/{$path}";
        }

        return $layerPath;
    }

    /**
     * Generate domain namespace
     *
     * @param string|null $path
     * @return string
     */
    protected function domainNamespace(string $path = null) : string
    {
        return $this->generateLayerNamespace(
            'Domains',
            $this->argument('domain'),
            $path
        );
    }

    /**
     * Generate domain base path
     *
     * @param string|null $path
     * @return string
     */
    protected function domainPath(string $path = null) : string
    {
        return $this->generateLayerPath(
            'Domains',
            $this->argument('domain'),
            $path
        );
    }

    /**
     * Generate unit namespace
     *
     * @param string|null $path
     * @return string
     */
    protected function unitNamespace(string $path = null) : string
    {
        return $this->generateLayerNamespace(
            'Units',
            $this->argument('unit'),
            $path
        );
    }

    /**
     * Generate unit base path
     *
     * @param string|null $path
     * @return string
     */
    protected function unitPath(string $path = null) : string
    {
        return $this->generateLayerPath(
            'Units',
            $this->argument('unit'),
            $path
        );
    }
}
