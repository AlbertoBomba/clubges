<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StoreCompanyInSession
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * si el login es correcto, coge el company_id del usuario y lo almacena en la sesión.
     */
    public function handle(Login $event)
    {
       
        session(['company_id' => $event->user->company_id]);
    }
}
