<?php

namespace Car7axo\Laravel\Support\Unit;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

/**
 * Class RouteServiceProvider
 * @package App\Modules\Deal\Providers
 */
abstract  class RouteServiceProvider extends ServiceProvider
{

    /**
     * Route prefix
     *
     * @var string $prefix
     */
    protected $prefix = null;

    /**
     * API Version
     *
     * @var string $apiVersion
     */
    protected $apiVersion = 'v1';

    /**
     * Controller namespace
     *
     * @return string
     */
    protected function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Map routes
     *
     * @throws UnitException
     */
    public function map()
    {
        try {

            $this->mapApiRoutes();

            $this->mapWebRoutes();

        } catch (\Exception $exception) {
            throw new UnitException($exception->getMessage());
        }

    }


    /**
     * Map routes
     *
     * @throws \ReflectionException
     */
    protected function mapWebRoutes()
    {
        $webRoutes = $this->path('Routes/web.php');

        if (file_exists($webRoutes)) {
            Route::prefix($this->prefix)
                ->middleware('web')
                ->namespace($this->getNamespace())
                ->group($webRoutes);
        }
    }

    /**
     * Map api endpoints
     *
     * @throws \ReflectionException
     */
    protected function mapApiRoutes()
    {
        $apiRoutes = $this->path('Routes/api.php');
        $prefix = $this->apiVersion;

        if ($this->prefix) {
            $prefix = "{$prefix}/{$this->prefix}/";
        }

        if (file_exists($apiRoutes)) {
            Route::prefix($prefix)
                ->middleware(['api'])
                ->namespace($this->getNamespace())
                ->group($apiRoutes);
        }
    }


    /**
     * @param null $append
     * @return bool|string
     * @throws \ReflectionException
     */
    protected function path($append = null)
    {
        $reflection = new \ReflectionClass($this);
        $realPath = realpath(dirname($reflection->getFileName()).'/../');
        if (!$append) {
            return $realPath;
        }

        return $realPath.'/'.$append;
    }

}
