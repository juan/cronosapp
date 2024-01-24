<?php

namespace App\Listeners\Registro;

use App\Events\Registro\NewUserMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
     * @param  \App\Events\Registro\NewUserMail  $event
     * @return void
     */
    public function handle(NewUserMail $event)
    {
        //
    }
}
