<?php

namespace App\Listeners\Patient;

use App\Events\Patient\NewEmailPatient;
use App\Mail\Patient\NewPatient;
use Mail;

class SendEmailNewPatient
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
    public function handle(NewEmailPatient $event)
    {

        Mail::to($event->patient->email_patient)->queue(
            new NewPatient($event)
        );
    }
}
