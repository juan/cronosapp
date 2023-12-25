<?php

namespace App\Providers;

use App\Classes\Registro\Prestador\InsuranceClas;
use App\Classes\Registro\Principal\PacienteRecord;
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
    private PacienteRecord $pacienteRecord;

    private InsuranceClas $insuraclas;

    public function register()
    {

        $this->app->singleton('userconfig', function () {
            return new UserConfig(new UserConfigValidation());
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
