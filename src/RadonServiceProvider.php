<?php

namespace Wama\Radon;

use Illuminate\Support\ServiceProvider;

class RadonServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'wamadev');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'wamadev');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/radon.php', 'radon');

        // Register the service the package provides.
        $this->app->singleton('radon', function ($app) {
            return new Radon;
        });

        $this->registerMacros();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['radon'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../config/radon.php' => config_path('radon.php'),
        ], 'radon.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/wamadev'),
        ], 'radon.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/wamadev'),
        ], 'radon.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/wamadev'),
        ], 'radon.views');*/

        // Registering package commands.
        // $this->commands([]);
    }


    /**
     * Registers macros
     *
     * @return void
     */
    public function registerMacros()
    {
        /*
         * Carbon macros
         */

        $toJalali = function () {
            return new Radon($this);
        };

        \Carbon\Carbon::macro('toJalali', $toJalali);
        \Carbon\Carbon::macro('shamsi', $toJalali); // Alias


        /*
         * Builder / Eloquent macros
         */

        \Illuminate\Database\Eloquent\Collection::macro('whereBetweenJalali', function ($column, $dates) {
            return $this->whereBetween($column, array($dates[0]->formatGregorian('Y-m-d'), $dates[1]->formatGregorian('Y-m-d')));
        });

        \Illuminate\Database\Eloquent\Builder::macro('whereBetweenJalali', function ($column, $dates) {
            return $this->whereBetween($column, array($dates[0]->formatGregorian('Y-m-d'), $dates[1]->formatGregorian('Y-m-d')));
        });

        \Illuminate\Database\Eloquent\Builder::macro('orWhereBetweenJalali', function ($column, $dates) {
            return $this->orWhereBetween($column, array($dates[0]->formatGregorian('Y-m-d'), $dates[1]->formatGregorian('Y-m-d')));
        });

        \Illuminate\Database\Eloquent\Builder::macro('whereDateJalali', function ($column, $date) {
            $date = $date instanceof Radon ? $date : new Radon();
            return $this->whereDate($column, $date->formatGregorian('Y-m-d'));
        });

        \Illuminate\Database\Eloquent\Builder::macro('whereDayJalali', function ($column, $date) {
            $date = $date instanceof Radon ? $date : (new Radon())->day($date);
            return $this->whereDay($column, $date->formatGregorian('d'));
        });

        \Illuminate\Database\Eloquent\Builder::macro('whereMonthJalali', function ($column, $date) {
            $date = $date instanceof Radon ? $date : (new Radon())->month($date);
            return $this->whereMonth($column, $date->formatGregorian('m'));
        });

        \Illuminate\Database\Eloquent\Builder::macro('whereYearJalali', function ($column, $date) {
            var_dump($date);
            $date = $date instanceof Radon ? $date : (new Radon())->year($date);
            return $this->whereYear($column, $date->formatGregorian('Y'));
        });
    }
}
