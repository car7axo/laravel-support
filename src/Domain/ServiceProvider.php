<?php
namespace Car7axo\Laravel\Support\Domain;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

/**
 * Class DomainServiceProvider
 * @package App\Support\Providers
 */
abstract class ServiceProvider extends LaravelServiceProvider
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
    protected $hasFactories = false;

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
     * @throws \Exception
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
            throw new DomainException($exception->getMessage());
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
     *  Domain directory
     *
     * @param null $append
     * @return string
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

    /**
     * Register model observers
     *
     * @param array $observers
     */
    protected function registerObservers(array $observers)
    {
        if ($observers && count($observers)) {
            foreach ($observers as $entity => $observer) {
                /** @var \Illuminate\Database\Eloquent\Model $entity */
                $entity::observe($observer);
            }
        }
    }

}
