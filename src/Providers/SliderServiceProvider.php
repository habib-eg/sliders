<?php

namespace Habib\Slider\Providers;

use Illuminate\Support\ServiceProvider;

class SliderServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__).'/config/slider.php', 'slider'
        );

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $package_path=dirname(__DIR__);
        //publish config comment.php
        $this->publishes([
            $package_path.'/config/slider.php' => config_path('slider.php'),
        ],'config');

        //publish views
        $this->publishes([
            $package_path.'/resources/views' => resource_path('views/vendor/slider'),
        ], 'views');

        //publish views
        $this->publishes([
            $package_path.'/resources/lang' => resource_path('lang/vendor/slider'),
        ], 'lang');

        //publish migrations
        $this->publishes([
            $package_path.'/database/migrations/' => database_path('migrations')
        ], 'migrations');

        $this->loadViewsFrom($package_path.'/resources/views','slider');
        $this->loadTranslationsFrom($package_path.'/resources/lang','slider');
        $this->loadMigrationsFrom($package_path.'/database/migrations');
    }
}
