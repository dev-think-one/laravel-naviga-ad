<?php

namespace NavigaAdClient;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/naviga-ad.php' => config_path('naviga-ad.php'),
            ], 'config');


            $this->commands([]);
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/naviga-ad.php', 'naviga-ad');

        $this->app->singleton('naviga_ad', function ($app) {
            return new NavigaAdApi(
                $app['config']->get('naviga-ad.credentials'),
                $app['config']->get('naviga-ad.base_url'),
                $app['config']->get('naviga-ad.options', []),
            );
        });
    }
}
