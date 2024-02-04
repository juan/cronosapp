<?php

namespace App\Providers;

use App\Classes\Registro\Principal\UserRecord;
use App\Classes\Registro\Principal\UserValidation;
use App\Classes\Utilidad\UserConfig;
use App\Classes\Utilidad\UserConfigValidation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /*userconfig: using to configure roles,menus, query action to a user*/
        $this->app->singleton('userconfig', function () {
            return new UserConfig(new UserConfigValidation());
        });

        /*userdata: using to create, update, show, delete a user*/
        $this->app->singleton('userdata', function () {
            return new UserRecord(new UserValidation());
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Configuration in Model

        Model::preventLazyLoading(! $this->app->isProduction());
        Model::preventSilentlyDiscardingAttributes(! $this->app->isProduction());
        Model::preventAccessingMissingAttributes(! $this->app->isProduction());

    }
}
