<?php

namespace App\Providers;

use App\Events\Patient\NewEmailPatient;
use App\Events\Registro\NewUserMail;
use App\Listeners\LogActivity;
use App\Listeners\Patient\SendEmailNewPatient;
use App\Listeners\Registro\SendNewUserEmail;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen
        = [
            Registered::class => [
                SendEmailVerificationNotification::class,
            ],
            Login::class => [

                LogActivity::class.'@login',
            ],
            Logout::class => [
                LogActivity::class.'@logout',
            ],
            NewEmailPatient::class => [
                SendEmailNewPatient::class,
            ],
            NewUserMail::class => [
                SendNewUserEmail::class,
            ],
        ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
