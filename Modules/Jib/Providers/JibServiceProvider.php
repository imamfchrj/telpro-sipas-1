<?php

namespace Modules\Jib\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

use Modules\Jib\Repositories\Admin\Interfaces\PengajuanRepositoryInterface;
use Modules\Jib\Repositories\Admin\PengajuanRepository;
use Modules\Jib\Repositories\Admin\Interfaces\InitiatorRepositoryInterface;
use Modules\Jib\Repositories\Admin\InitiatorRepository;
use Modules\Jib\Repositories\Admin\Interfaces\SegmentRepositoryInterface;
use Modules\Jib\Repositories\Admin\SegmentRepository;
use Modules\Jib\Repositories\Admin\Interfaces\CustomerRepositoryInterface;
use Modules\Jib\Repositories\Admin\CustomerRepository;
use Modules\Jib\Repositories\Admin\Interfaces\KategoriRepositoryInterface;
use Modules\Jib\Repositories\Admin\KategoriRepository;
use Modules\Jib\Repositories\Admin\Interfaces\JenisRepositoryInterface;
use Modules\Jib\Repositories\Admin\JenisRepository;
use Modules\Jib\Repositories\Admin\Interfaces\PemeriksaRepositoryInterface;
use Modules\Jib\Repositories\Admin\PemeriksaRepository;
use Modules\Jib\Repositories\Admin\Interfaces\ReviewRepositoryInterface;
use Modules\Jib\Repositories\Admin\ReviewRepository;
use Modules\Jib\Repositories\Admin\Interfaces\PersetujuanRepositoryInterface;
use Modules\Jib\Repositories\Admin\PersetujuanRepository;
use Modules\Jib\Repositories\Admin\Interfaces\MomRepositoryInterface;
use Modules\Jib\Repositories\Admin\MomRepository;
use Modules\Jib\Repositories\Admin\Interfaces\KesimpulanRepositoryInterface;
use Modules\Jib\Repositories\Admin\KesimpulanRepository;
use Modules\Jib\Repositories\Admin\Interfaces\AnggaranRepositoryInterface;
use Modules\Jib\Repositories\Admin\AnggaranRepository;
use Modules\Jib\Repositories\Admin\Interfaces\RisikoRepositoryInterface;
use Modules\Jib\Repositories\Admin\RisikoRepository;

class JibServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Jib';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'jib';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        $this->registerRepositories();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }

    private function registerRepositories()
    {
        $this->app->bind(
            PengajuanRepositoryInterface::class,
            PengajuanRepository::class
        );

        $this->app->bind(
            InitiatorRepositoryInterface::class,
            InitiatorRepository::class
        );

        $this->app->bind(
            SegmentRepositoryInterface::class,
            SegmentRepository::class
        );

        $this->app->bind(
            CustomerRepositoryInterface::class,
            CustomerRepository::class
        );

        $this->app->bind(
            KategoriRepositoryInterface::class,
            KategoriRepository::class
        );

        $this->app->bind(
            PemeriksaRepositoryInterface::class,
            PemeriksaRepository::class
        );

        $this->app->bind(
            ReviewRepositoryInterface::class,
            ReviewRepository::class
        );

        $this->app->bind(
            JenisRepositoryInterface::class,
            JenisRepository::class
        );

        $this->app->bind(
            PersetujuanRepositoryInterface::class,
            PersetujuanRepository::class
        );

        $this->app->bind(
            MomRepositoryInterface::class,
            MomRepository::class
        );

        $this->app->bind(
            KesimpulanRepositoryInterface::class,
            KesimpulanRepository::class
        );

        $this->app->bind(
            AnggaranRepositoryInterface::class,
            AnggaranRepository::class
        );

        $this->app->bind(
            RisikoRepositoryInterface::class,
            RisikoRepository::class
        );

    }
}
