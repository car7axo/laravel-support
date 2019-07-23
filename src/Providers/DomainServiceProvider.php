<?php
namespace Car7axo\Laravel\Support\Providers;

use App\Support\Providers\Exceptions\DomainServiceProviderException;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

/**
 * Class DomainServiceProvider
 * @package App\Support\Providers
 */
abstract class DomainServiceProvider extends ServiceProvider
{

    /**
     * Register migrations
     *
     * @var bool
     */
    protected $hasMigrations = true;

    /**
     * Register factories
     * @var bool
     */
    protected $hasFactories = true;

    /**
     * @var array List of domain providers to register
     */
    public $providers = [];

    /**
     * @var array Contract bindings
     */
    public $bindings = [];

    /**
     * @var array $observers
     */
    protected $observers = [];


    public function boot()
    {
        // Register model observers
        $this->registerObservers($this->observers);
    }

    /**
     * Register the current Domain.
     *
     * @throws DomainServiceProviderException
     */
    public function register()
    {
        try {
            // Register Sub Providers
            $this->registerProviders(collect($this->providers));

            // Register bindings.
            $this->registerBindings(collect($this->bindings));

            // Register migrations.
            if ($this->hasMigrations) {
                $this->loadMigrationsFrom($this->domainPath('Database/Migrations'));
            }

            // Register model Factories.
            if ($this->hasFactories) {
                $this->registerFactories();
            }
        } catch (\Exception $exception) {
            throw new DomainServiceProviderException('Unable to load domain: ' . $exception->getMessage());
        }
    }
    /**
     * Register domain sub providers.
     *
     * @param Collection $providers
     */
    protected function registerProviders(Collection $providers)
    {
        $providers->each(function ($provider) {
            $this->app->register($provider);
        });
    }
    /**
     * Register the defined domain bindings.
     *
     * @param Collection $bindings
     */
    protected function registerBindings(Collection $bindings)
    {
        $bindings->each(function ($concretion, $abstraction) {
            $this->app->bind($abstraction, $concretion);
        });
    }

    /**
     * Register a database migration path.
     *
     * @param  array|string  $paths
     * @return void
     */
    protected function loadMigrationsFrom($paths)
    {
        $this->app->afterResolving('migrator', function ($migrator) use ($paths) {
            foreach ((array) $paths as $path) {
                $migrator->path($path);
            }
        });
    }

    /**
     * Register Model Factories.
     *
     * @throws \ReflectionException
     */
    protected function registerFactories()
    {
        if (! app()->environment('production')) {
            app(Factory::class)->load(
                $this->domainPath('Database/factories')
            );
        }
    }

    /**
     *  Detect domain directory
     *
     * @param null $append
     * @return bool|string
     * @throws \ReflectionException
     */
    protected function domainPath($append = null)
    {
        $reflection = new \ReflectionClass($this);
        $realPath = realpath(dirname($reflection->getFileName()).'/../');
        if (!$append) {
            return $realPath;
        }
        return $realPath.'/'.$append;
    }

    protected function registerObservers(array $observers)
    {
        if ($observers && count($observers)) {
            foreach ($observers as $entity => $observer)
            {
                /**
                 * @var Model $entity
                 */
                $entity::observe($observer);
            }
        }
    }

}
