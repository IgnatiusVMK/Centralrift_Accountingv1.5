<?php

namespace App\Listeners;

use App\Jobs\SendMail;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendLoginEmailNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

   /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user = $event->user;

        // Dispatch the SendMail job
        SendMail::dispatch($user);
    }
}
