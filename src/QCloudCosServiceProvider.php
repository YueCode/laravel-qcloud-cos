<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 2017/3/3
 * Time: 11:18
 */

namespace YueCode\Cos;

use Illuminate\Support\ServiceProvider;

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
        $this->publishes([
            __DIR__ . '/config/qcloudcos.php' => config_path('qcloudcos.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app['qcloudcos'] = new QCloudCos($this->app['config']);
    }
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['qcloudcos'];
    }
}
