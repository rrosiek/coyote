<?php
namespace App\Listeners;

use App\Mail\ActivateNewUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class UserRegistered implements ShouldQueue
{
    /**
     * @param  \Illuminate\Auth\Events\Registered $event
     * @return void
     */
    public function handle(Registered $event)
    {
        Mail::to(env('MAIL_WEBADMIN'))->send(new ActivateNewUser($event->user));
    }
}
