<?php

namespace App\Providers;

use App\Models\Action;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies
        = [
            // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(Gate $gate)
    {
        parent::registerPolicies($gate);
        //

        foreach ($this->getAction() as $data) {
            $gate::define($data->name_action, function ($user) use ($data) {
                return $user->hasRole($data->roles);
            });
        }
    }

    private function getAction()
    {
        return Action::with('roles')->get();
    }
}
