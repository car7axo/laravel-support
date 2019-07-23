<?php
namespace Car7axo\Laravel\Support\Providers;

use App\Support\Providers\Exceptions\ModuleServiceProviderException;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

/**
 * Class ModuleServiceProvider
 * @package App\Support
 */
abstract class ModuleServiceProvider extends ServiceProvider {
    /**
     * @var array List of Module Service Providers to Register
     */
    protected $providers = [];
    /**
     * @var array Contract bindings
     */
    public $bindings = [];
    /**
     * @var string Module Alias for Translations and Views
     */
    protected $alias = null;
    /**
     * @var bool Enable views loading on the Unity
     */
    protected $hasViews = false;
    /**
     * @var bool Enable translations loading on the Unity
     */
    protected $hasTranslations = false;

    /**
     * Boot required registering of views and translations.
     *
     * @throws ModuleServiceProviderException
     */
    public function boot()
    {
        try {
            // register module translations.
            $this->registerTranslations();
            // register module views.
            $this->registerViews();
        } catch (\Exception $exception) {
            throw new ModuleServiceProviderException("Unable to load module:  " . $exception->getMessage());
        }
    }

    public function register()
    {
        // register module custom domains.
        $this->registerProviders(collect($this->providers));
        // Register bindings.
        $this->registerBindings(collect($this->bindings));
    }

    /**
     * Register Module Custom ServiceProviders.
     *
     * @param Collection $providers
     */
    protected function registerProviders(Collection $providers)
    {
        // loop through providers to be registered.
        $providers->each(function ($providerClass) {
            // register a provider class.
            $this->app->register($providerClass);
        });
    }

    /**
     * Register module translations.
     *
     * @throws \ReflectionException
     */
    protected function registerTranslations()
    {
        if ($this->hasTranslations) {
            $this->loadTranslationsFrom(
                $this->modulePath('Resources/lang'),
                $this->alias
            );
        }
    }

    /**
     * Register module views.
     *
     * @throws \ReflectionException
     */
    protected function registerViews()
    {
        if ($this->hasViews) {
            $this->loadViewsFrom(
                $this->modulePath('Resources/views'),
                $this->alias
            );
        }
    }
    /**
     * Detects the module base path so resources can be proper loaded
     * on child classes.
     *
     * @param null $append
     * @return bool|string
     * @throws \ReflectionException
     */
    protected function modulePath($append = null)
    {
        $reflection = new \ReflectionClass($this);
        $realPath = realpath(dirname($reflection->getFileName()).'/../');
        if (!$append) {
            return $realPath;
        }
        return $realPath.'/'.$append;
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
}
