<?php

namespace App\Listeners\Registro;

use App\Events\Registro\NewUserMail;
use App\Mail\Registro\NewUser;
use Mail;

class SendNewUserEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(NewUserMail $event)
    {
        Mail::to($event->user->email)->send(
            new NewUser($event)
        );
    }
}
