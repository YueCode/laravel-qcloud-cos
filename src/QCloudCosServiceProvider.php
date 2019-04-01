<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 2017/3/3
 * Time: 11:18
 */

namespace YueCode\Cos;

use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

class QCloudCosServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        if ($this->app->runningInConsole()) {
            if ($this->app instanceof LumenApplication) {
                $this->app->configure('cos');
            } else {
                $this->publishes([
                    $this->getConfigFile() => config_path('cos.php'),
                ], 'config');
            }
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom($this->getConfigFile(), 'cos');
        //
        $this->app->bind('cos', function () {
            return new QCloudCos($this->app['config']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['cos'];
    }

    /**
     * @return string
     */
    protected function getConfigFile()
    {
        $file = base_path() . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'cos.php';
        if (file_exists($file)) {
            return $file;
        }
        return __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'cos.php';
    }

}
