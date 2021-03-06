<?php
namespace Gazatem\Glog\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class GlogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../public' => public_path('vendor/gazatem/glog'),
            ], 'public');

            $this->publishes([
                __DIR__ . '/../../config/glog.php' => config_path('glog.php'),
            ], 'glog-config');

            $this->publishes([
                __DIR__ . '/../../resources/lang/' => resource_path('lang/vendor/glog'),
            ]);
        }
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang/', 'glog');

        Route::group([
            'prefix' => config("glog.route-prefix"),
            'middleware' => config("glog.middlewares", 'web'),
            'namespace' => 'Gazatem\Glog\Http\Controllers',
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
        });

        $this->loadMigrationsFrom(__DIR__ . '/../../migrations');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'glog');
        $this->bladeDirectives();
    }

    private function bladeDirectives()
    {
        \Blade::directive('logMessage', function ($log_text) {
            return "<?php \\Gazatem\Glog\OutputGenerator::get_message({$log_text}); ?>";
        });
    }

/**
 * Register the application services.
 *
 * @return void
 */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/glog.php', 'glog');
        $this->app->singleton('glog', function ($app) {
            return new Glog;
        });
    }

    public function provides()
    {
        return ['glog'];
    }
}
